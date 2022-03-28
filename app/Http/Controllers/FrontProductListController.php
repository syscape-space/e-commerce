<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontProductListController extends Controller
{
    public function index()
    { 
        $products = Product::latest()->limit(9)->get();
        $randomActiveProducts = Product::inRandomOrder()->limit(3)->get();
        $randomActiveProductId =[];
        foreach ($randomActiveProducts as $product) {
            array_push($randomActiveProductId,$product->id);
        }
        $randomItemProducts = Product::whereNotIn('id',$randomActiveProductId)->limit(3)->get();

        return view('product', compact('products','randomItemProducts','randomActiveProducts'));
    }

    public function show($id)
    {
        $product = Product::find($id);
        $productFromSameCategory= Product::inRandomOrder()->where('category_id',$product->category_id)
            ->where('id','!=',$product->id)
            ->limit(3)->get();
        return view('productshow',compact('product','productFromSameCategory'));
    }



}
