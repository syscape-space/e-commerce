<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    //store Order
    public function store(Request $request)
    {
    $request->validate([
        'shipping_fullname' => 'required',
        'shipping_state' => 'required',
        'shipping_city' => 'required',
        'shipping_address' => 'required',
        'shipping_phone' => 'required',
        'shipping_zipcode' => 'required',
        'payment_method' => 'required',
    ]);

    $order = new Order();

    $order->order_number = uniqid('OrderNumber-');

    $order->shipping_fullname = $request->input('shipping_fullname');
    $order->shipping_state = $request->input('shipping_state');
    $order->shipping_city = $request->input('shipping_city');
    $order->shipping_address = $request->input('shipping_address');
    $order->shipping_phone = $request->input('shipping_phone');
    $order->shipping_zipcode = $request->input('shipping_zipcode');


    $order->grand_total = \Darryldecode\Cart\Facades\CartFacade::session(auth()->id())->getTotal();
    $order->item_count = \Darryldecode\Cart\Facades\CartFacade::session(auth()->id())->getTotalQuantity();

    $order->user_id = auth()->id();

    if (request('payment_method') == 'paypal') {
        $order->payment_method = 'paypal';
    }

    $order->save();

    \Darryldecode\Cart\Facades\CartFacade::session(auth()->id())->clear();

    //send notification
    $admins=User::where('role','admin')->get();
        $msg = "There are new Orders need to accept" ;
        (new NotificationController)->sendNotification($admins , $msg);

    return redirect()->route('frontend')->with('success','Order has been placed');

}
    //show all orders to accept
    public function listOrdersToAccept(){
        $orders = Order::where('status', 'pending')->get();
        return view('admin.order.purchaseOrder')->with('orders',$orders);
    }

    // Acceppt orders
    public function acceptOrder($order_id)
        {
            $order = Order::find($order_id);
            if($order->status == 'pending') {
                $order->status = 'approved';
                $order->update();

                $msg = "Your order with ".$order->order_number." is approved successfully";
                (new NotificationController)->sendNotification($order->user, $msg);
                return redirect()->route('orders.accept.list')->with('success', 'order Is Accepted Successfully');

            } else {
                return redirect()->route('orders.accept.list')->with('success', 'The order Is already Accepted');
            }
        }


    // decline orders
    public function declineOrder($order_id)
    {
        $order = Order::find($order_id);
        if($order->status == 'pending') {
            $order->status = 'decline';
            $order->update();
            $msg = "Your order with ".$order->order_number. " is declined";
            (new NotificationController)->sendNotification($order->user, $msg);
            return redirect()->route('orders.accept.list')->with('success', 'order Is declined Successfully');
        } else {
            return redirect()->route('orders.accept.list')->with('success', 'The order Is already Accepted');   
        }   
    }

    // show users orders
    public function userOrders($user_id){
        $orders=Order::where('user_id',$user_id)->get();
        return view('order.order')->with('orders',$orders);
    }

    // delete order
    public function deleteOrder($order_id){
        $order=Order::find($order_id)->forcedelete();
        return back()->with('success','Order delete successfuly');
    }

    //mark orders as delivered
    public function markOrderAsDelivered($order_id){
        $order=Order::find($order_id);
        if($order->status == 'approved') {
            $order->status = 'delivered';
            $order->update();
            return back()->with('success', 'Order marked as delivered');
        } else {
            return back()->with('success', 'This order is not approved');   
        }
    }
}
