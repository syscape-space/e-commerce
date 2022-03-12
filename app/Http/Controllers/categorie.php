<?php

namespace App\Http\Controllers;

use App\Models\category as ModelsCategorie;
use Illuminate\Http\Request;

class categorie extends Controller
{
    /*
        creating new category
    */
    public function Create()
    {
        // $category = ModelsCategorie::create($request->only(['name', 'description', 'image']));
        // return redirect()->route('admin.posts.edit', $post)->withSuccess(__('posts.created'));
    }

    public function Read_all()
    {
        // $all = ModelsCategorie::all();
        // return $all;
    }
    /*
    updating specific category with the givan id
    */
    public function Update($category_id,Request $request)
    {
        // $category_id->update($request->only(['name', 'image', 'description']));
        // return redirect()->back()->withSuccess('edited Successfully');
     }

    public function Destroy($category_id)
    {
        // $category_id->delete();
        // return redirect()->route('home')->withSuccess('caegory has been deleted Successfully');
    }

}
