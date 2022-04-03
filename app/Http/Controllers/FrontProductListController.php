<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;


use Illuminate\Http\Request;

class FrontProductListController extends Controller
{

    public function index(){
        $products =  Product::latest()->limit(9)->get();
        $randomActiveProducts = Product::inRandomOrder()->limit(3)->get();
        $randomActiveProductIds=[];
        foreach($randomActiveProducts as $product){
            array_push($randomActiveProductIds,$product->id);
        }
        $randomItemProducts = Product::whereNotIn('id',$randomActiveProductIds)->limit(3)->get();

        return view('frontend',compact('products','randomItemProducts','randomActiveProducts'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $productFromSameCategory= Product::inRandomOrder()->where('category_id',$product->category_id)
            ->where('id','!=',$product->id)
            ->limit(3)->get();
        return view('productshow',compact('product','productFromSameCategory'));
    }

    public function allProduct($name,Request $request){

        $category  = Category::where('name',$name)->first();
        $categoryId = $category->id;
        $filterSubCategories=[]; $price=[];

        if($request->subcategory) {
            $products = Product::whereIn('subcategory_id',$request->subcategory)->get();
            $filterSubCategories = SubCategory::whereIn('id',$request->subcategory)->pluck('id')->toArray();   
        }

        elseif($request->min||$request->max) {
            $products =Product::whereBetween('price',[$request->min,$request->max ])->where('category_id',$request->categoryId)->get();
        }

        else {
            $products = Product::where('category_id',$category->id)->get();
        }

        $subcategories = SubCategory::where('category_id',$category->id)->get();
        return view('category',compact('products','subcategories','name','filterSubCategories','categoryId'));
    }






}
