<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontProductListController extends Controller
{
    public function index()
    { 
        $products = Product::get();
        return view('product', compact('products'));
    }
}
