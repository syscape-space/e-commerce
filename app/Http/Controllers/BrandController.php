<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware(['auth']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::all();
        return view('admin.brand.index')->with('brands',$brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBrandRequest $request)
    {
        $this->validate($request,[
            'name'=>'required|Unique:brands',
            'logo'=>'max:1999|image|nullable',
        ]);

        //Handle file upload
        if($request->hasFile('logo')){
            $file=$request->file('logo');
            $filename=md5(file_get_contents($file->getRealPath())) .'.'. $file->extension();
            $path=$request->file('logo')->storeAs('public/brands_logo',$filename);

        }else {
            $filename='noImage.jpg';
        }
        $brand=new Brand;
        $brand->name=$request->input('name');
        $brand->logo=$filename;
        $brand->vendor_id=auth()->user()->id;
        $brand->save();

        // $users=User::all();
        //Notification::send($users,new brandNotification($request->name));
        // $admins=User::where('role','admin')->get();
        // $msg = "There are new brands need to accept" ;
        // (new NotificationController)->sendNotification($admins , $msg);
        return redirect()->route('brand.create')->with('success','Brand created successfully');
    
     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        return view('vendor.brand.show')->with('brand',$brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        if(auth()->user()->id !== $brand->vendor_id){
            return redirect('/brand')->with('error','You can not edit this brand');
        }
        return view('vendor.brand.edit')->with('brand',$brand);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $this->validate($request,[
            'name'=>['required',Rule::unique('brands')->ignore(request('name'),'name')],
            'logo'=>'max:1999|image|nullable',
        ]);

        //Handle file upload
        if($request->hasFile('logo')){
            $file=$request->file('logo');
            $filename=md5(file_get_contents($file->getRealPath())) .'.'. $file->extension();
            $path=$request->file('logo')->storeAs('public/brands_logo',$filename);
            $brand->logo=$filename;
        }
        $brand->name=$request->input('name');
        $brand->vendor_id=auth()->user()->id;
        if($request->hasFile('logo')){
            $brand->logo=$filename;
        }
        $brand->save();
        return redirect()->route('all.vendor.brands')->with('success','brand edited successfuly');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }


    //trash page for admin
    public function trash()
    {
        $brands = Brand::onlyTrashed()->latest()->paginate(4);
        return view('admin.brand.trash', compact('brands'));
    }

    //soft Delete for admin
    public function softdelete($id)
    {
        $brand = Brand::find($id)->delete();
         return redirect()->route('brand.index')->with('success', 'brand Is Moved To Trash');
    }
    //Hard Delete for admin
    public function hardDelete($id)
    {
        $brand = Brand::onlyTrashed()->where('id',$id)->forcedelete();
         return redirect()->route('brand.trash')->with('success', 'brand Is Deleted Successfully');
    }
    //Back from trash for admin
    public function backFromTrash ($id)
    {
        $task = Brand::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->route('brand.index')->with('success', 'brand Is Back from trash Successfully');
    }


    //trash page
    public function trashBrand()
    {
        $brands = Brand::onlyTrashed()->latest()->paginate(4);
        return view('vendor.brand.trash', compact('brands'));
    }

    //soft Delete
    public function softdeleteBrand($id)
    {
        $brand = Brand::find($id);
        if($brand->vendor_id==auth()->user()->id){
            $brand->delete();
            return redirect()->route('all.vendor.brands')->with('success', 'brand Is Moved To Trash');
            }
        else
            {
                return redirect()->route('all.vendor.brands')->with('success', 'you can not delete this brand');
            }
    }
    //Hard Delete
    public function hardDeleteBrand($id)
    {
        $brand = Brand::onlyTrashed()->where('id',$id)->forcedelete();
         return redirect()->route('brand.vendor.trash')->with('success', 'brand Is Deleted Successfully');
    }
    //Back from trash
    public function backFromTrashBrand ($id)
    {
        $task = Brand::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->route('all.vendor.brands')->with('success', 'brand Is Back from trash Successfully');
    }

    //trash page
    public function trashProduct()
    {
        $products = Product::onlyTrashed()->latest()->paginate(4);
        return view('vendor.product.trash', compact('products'));
    }

    //soft Delete
    public function softdeleteProduct($id)
    {
        $product = Product::find($id);
        if($product->vendor_id==auth()->user()->id){
            $product->delete();
            return redirect()->back()->with('success', 'product Is Moved To Trash');
            }
        else
            {
                return redirect()->back()->with('success', 'you can not delete this brand');
            }
    }
    //Hard Delete
    public function hardDeleteProduct($id)
    {
        $product = Product::onlyTrashed()->where('id',$id)->forcedelete();
         return redirect()->back()->with('success', 'product Is Deleted Successfully');
    }
    //Back from trash
    public function backFromTrashProduct ($id)
    {
        $task = Product::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->back()->with('success', 'product Is Back from trash Successfully');
    }

    //brands which belongs to vendor
    public function vendorBrands(){
        $brands=Brand::where('vendor_id',auth()->user()->id)->get();
        return view('vendor.brand.index')->with('brands',$brands);
    }

    //show brand
    public function showBrand($id){
        $brand=Brand::find($id);
        $products=Product::where('is_acceptable','!=', NULL)->where('brand_id',$brand->id)->get();
        return view('vendor.brand.show',compact('brand','products'));
    }

    //show all products
    public function showProducts(){
        $products = Product::where('is_acceptable','!=', NULL)->latest()->paginate(4);
        return view('vendor.product.index', compact('products'));
    }

    //show single product
    public function showSingleProduct($id){
        $product=Product::find($id);
        if($product->is_acceptable!=Null){
        return view('vendor.product.show',compact('product'));}
        else{
            return redirect()->route('all.vendor.brands')->with('success','this product is not acceptable yet');
        }
    }

    //show all products to this vendor
    public function showMyProducts(){
        $products = Product::where('vendor_id',auth()->user()->id)->where('is_acceptable','!=', NULL)->get();
        return view('vendor.product.myProduct', compact('products'));
    }

    //show all category
    public function showAllCategory(){
        $categories=Category::all();
        return view('vendor.category.index',compact('categories'));
    }
    //show all subcategory
    public function showAllSubCategory(){
        $subCategories=SubCategory::all();
        return view('vendor.subcategory.index',compact('subCategories'));
    }

}
