<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    public function cartList()
    {
        $cartItems = \Darryldecode\Cart\Facades\CartFacade::getContent();
        // dd($cartItems);
        return view('cart', compact('cartItems'));
    }


    public function addToCart($product_id)
    {
        $product=Product::find($product_id);
        \Darryldecode\Cart\Facades\CartFacade::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'description'=> $product->description,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(
            ),
            'associatedModel' => $product
        ));
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return back();
    }

    public function update($rowId)
    {

        \Darryldecode\Cart\Facades\CartFacade::session(auth()->id())->update($rowId, [
            'quantity' => [
                'relative' => false,
                'value' => request('quantity')
            ]
        ]);

        return back();
    }


    public function destroy($itemId)
    {

        \Darryldecode\Cart\Facades\CartFacade::session(auth()->id())->remove($itemId);

        return back();
    }

    public function clearAllCart()
    {
        \Darryldecode\Cart\Facades\CartFacade::session(auth()->id())->clear();

        return back();
    }

    public function checkout()
    {
        return view('checkout');
    }
}
