<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(['auth']);
       $this->middleware(['Admin'])->except(['create','edit','update','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_acceptable','!=', NULL)->latest()->paginate(4);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands=Brand::where('vendor_id',auth()->user()->id)->get();
        return view('vendor.product.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|Unique:products',
            'description'=>'required',
            'price'=>'required|Numeric',
            'image'=>'max:1999|image|required',
            'category'=>'required',
            'brand_id'=>'required',
            'subcategory'=>'required'
        ]);

        //Handle file upload
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())).date('Y-m-d H-i-s').'.'. $file->extension();
            $path=$request->file('image')->storeAs('public/products_image',$filename);

        }else {
            $filename='noImage.jpg';
        }
        $product=new Product;
        $product->name=$request->input('name');
        $product->image=$filename;
        $product->vendor_id=auth()->user()->id;
        $product->brand_id=$request->input('brand_id');
        $product->category_id=$request->input('category');
        $product->subCategory_id=$request->input('subcategory');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->is_acceptable=Null;
        $product->save();

        // $users=User::all();
        //Notification::send($users,new ProductNotification($request->name));
        $admins=User::where('role','admin')->get();
        $msg = "There are new products need to accept" ;
        (new NotificationController)->sendNotification($admins , $msg);
        return redirect()->route('products.create')->with('success','waiting for the admin approval');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.product.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $brands=Brand::where('vendor_id',auth()->user()->id)->get();
        if(auth()->user()->id !== $product->vendor_id){
            return redirect('/products')->with('error','You can not edit this product');
        }
        return view('vendor.product.edit',compact('product','brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $this->validate($request,[
            'name'=>['required',Rule::unique('products')->ignore(request('name'),'name')],
            'description'=>'required',
            'price'=>'required|Numeric',
            'image'=>'max:1999|image|nullable',
            'category'=>'required',
            'brand_id'=>'required',
            'subcategory'=>'required',
        ]);
        

        //Handle file upload
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())).date('Y-m-d H-i-s').'.'. $file->extension();
            $path=$request->file('image')->storeAs('public/products_image',$filename);
            $product->image=$filename;
        }
        $product->name=$request->input('name');
        $product->vendor_id=auth()->user()->id;
        $product->brand_id=$request->input('brand_id');
        $product->category_id=$request->input('category');
        $product->subCategory_id=$request->input('subcategory');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        if($request->hasFile('image')){
            $product->image=$filename;
        }
        $product->save();
        return redirect()->back()->with('success','product edited successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {

        if($product->image != 'noImage.jpg'){
            Storage::delete('public/products_image/'.$product->image);
        }
        $product->delete();
        $data=array('products'=>$product,'success'=>'Deleted successed');
        return redirect('products')->with($data);
    }

    //trash page
    public function trash()
    {
        $products = Product::onlyTrashed()->latest()->paginate(4);
        return view('admin.product.trash', compact('products'));
    }

    //soft Delete
    public function softdelete($id)
    {
        $product = Product::find($id)->delete();
         return redirect()->route('products.index')->with('success', 'Product Is Moved To Trash');
    }
    //Hard Delete
    public function hardDelete($id)
    {
        // public function destroy($id){
        //     $product = Product::findOrFail($id);
    
        //     Storage::delete('public/uploads' . $product->product_img);
            
        //     $product->delete();
        //     return redirect('/products');
        // }
        $product = Product::onlyTrashed()->where('id',$id)->forcedelete();
         return redirect()->route('products.trash')->with('success', 'Product Is Deleted Successfully');
    }
    //Back from trash
    public function backFromTrash ($id)
    {
        $task = Product::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->route('products.index')->with('success', 'Product Is Back from trash Successfully');
    }
    public function listProductsToAccept ()
    {
        $products = Product::where('is_acceptable', Null)->get();
        return view('admin.product.accept', compact('products'));

    }

    public function AcceptProduct($product_id)
    {
        $product = Product::find($product_id);
        if($product->is_acceptable == Null) {
            $product->is_acceptable = now();
            $product->update();

            $msg = "Your ".$product->name." product is approved successfully";
            (new NotificationController)->sendNotification($product->vendor, $msg);
            return redirect()->route('products.accept.list')->with('success', 'Product Is Accepted Successfully');

        } else {
            return redirect()->route('products.accept.list')->with('success', 'The Product Is already Accepted');
        }
    }

    public function declineProduct($product_id)
    {
        $product = Product::find($product_id);
        if($product->is_acceptable == Null) {
            $product->delete();
            $this->hardDelete($product_id);
            $msg = "Your ".$product->name. " Product is declined";
            (new NotificationController)->sendNotification($product->vendor, $msg);
            return redirect()->route('products.accept.list')->with('success', 'Product Is Deleted Successfully');
        } else {
            return redirect()->route('products.accept.list')->with('success', 'The Product Is already Accepted');   
        }   
    }
}
