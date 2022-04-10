<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Notifications\ProductNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;



class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(['auth','Admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->paginate(4);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $users=User::all();
        $this->validate($request,[
            'name'=>'required|Unique:products',
            'description'=>'required',
            'price'=>'required|Numeric',
            'image'=>'max:1999|image|nullable',
            'category'=>'required',
            'subcategory'=>'required'
        ]);

        //Handle file upload
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())) .'.'. $file->extension();
            $path=$request->file('image')->storeAs('public/products_image',$filename);

        }else {
            $filename='noImage.jpg';
        }
        $product=new Product;
        $product->name=$request->input('name');
        $product->image=$filename;
        $product->vendor_id=auth()->user()->id;
        $product->category_id=$request->input('category');
        $product->subCategory_id=$request->input('subcategory');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->save();
        Notification::send($users,new ProductNotification($request->name));
        return redirect('products')->with('success','Product added successfuly');
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
        if(auth()->user()->id !== $product->vendor_id){
            return redirect('/products')->with('error','You can not edit this product');
        }
        return view('admin.product.edit')->with('product',$product);
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
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|Numeric',
            'image'=>'max:1999|image|nullable',
            'category'=>'required',
            'subcategory'=>'required',
        ]);

        //Handle file upload
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())) .'.'. $file->extension();
            $path=$request->file('image')->storeAs('public/products_image',$filename);

        }else {
            $filename='noImage.jpg';
        }
        $product->name=$request->input('name');
        $product->image=$filename;
        $product->vendor_id=auth()->user()->id;
        $product->category_id=$request->input('category');
        $product->subCategory_id=$request->input('subcategory');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        if($request->hasFile('image')){
            $product->image=$filename;
        }
        $product->save();
        return redirect('products')->with('success','product added successfuly');
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
        $product = Product::onlyTrashed()->where('id',$id)->forcedelete();
         return redirect()->route('products.trash')->with('success', 'Product Is Deleted Successfully');
    }
    //Back from trash
    public function backFromTrash ($id)
    {
        $task = Product::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->route('products.index')->with('success', 'Product Is Back from trash Successfully');
    }
}
