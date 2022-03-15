<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=Product::all();
        return view('products.index',$product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
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
            'name'=>'required|uniqe:products',
            'description'=>'required',
            'price'=>'required|Numeric',
            'image'=>'max:1999|image|nullable'
        ]);

        //Handle file upload
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())) . $file->extension();
            $path=$request->file('food_image')->storeAs('public/products_image',$filename);

        }else {
            $filename='noImage.jpg';
        }
        $product=new Product;
        $product->name=$request->input('name');
        $product->image=$filename;
        $product->vendor_id=auth()->id;
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->save();
        return redirect('products')->with('success','product added successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show')->with('product',$product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if(auth()->id !== $product->vendor->id){
            return redirect('/products/index')->with('error','You can not edit this product');
        }
        return view('products.edit',$product);
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
            'name'=>'required|uniqe:products',
            'description'=>'required',
            'price'=>'required|Numeric',
            'image'=>'max:1999|image|nullable'
        ]);

        //Handle file upload
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())) . $file->extension();
            $path=$request->file('food_image')->storeAs('public/products_image',$filename);

        }else {
            $filename='noImage.jpg';
        }
        $product->name=$request->input('name');
        $product->image=$filename;
        $product->vendor_id=auth()->id;
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
}
