<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index()
    {
        $subCategories = SubCategory::latest()->paginate(4);
        return view('subCategories.index', compact('subCategories'));
    }


    public function create()
    {
         return view('subCategories.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'categories_id'=>'required'
        ]);

        SubCategory::create($request->all());
        return redirect()->route('subCategories.index')->with('success','SubCategory is created successfully.');
    }

    public function show($id)
    {
        $subCategory = SubCategory::find($id)->first();
        return view('subCategories.show',compact('subCategory'));
    }

    
    public function edit($id)
    {
        $subCategory = SubCategory::find($id)->first();

        return view('subCategories.edit',compact('subCategory'));
    }

    public function update(Request $request, SubCategory $subcategory)
    {
        $request->validate([
            'name'=>'required',
            'categories_id'=>'required'
        ]);

        $subcategory->create($request->all());


         return redirect()->route('subCategories.index')
         ->with('success', 'SubCategory Is Updated Successfully'); 
    }

    public function destroy($id)
    {
        //$subcategory->delete();
        SubCategory::find($id)->first()->delete();
        return redirect()->route('subCategories.index')->with('success', 'SubCategory Is Deleted Successfully');
    }

    public function trash()
    {
        $subCategories = SubCategory::onlyTrashed()->latest()->paginate(4);
        return view('subCategories.trash', compact('subCategories'));
    }

    //soft Delete
    public function softdelete($id)
    {
        $subCategory = SubCategory::find($id)->delete();      
         return redirect()->route('subCategories.index')->with('success', 'SubCategory Is Moved To Trash');
    }
    //Hard Delete
    public function hardDelete($id)
    {
        $subCategory = SubCategory::onlyTrashed()->where('id',$id)->forcedelete();      
         return redirect()->route('subCategories.trash')->with('success', 'SubCategory Is Deleted Successfully');        
    }
//Back from trash 
    public function backFromTrash ($id)
    {
        $task = SubCategory::onlyTrashed()->where('id',$id)->first()->restore();      
         return redirect()->route('subCategories.index')->with('success', 'SubCategory Is Backed Successfully');
    }
}
