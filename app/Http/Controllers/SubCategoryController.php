<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function index()
    {
        $subcategories = SubCategory::latest()->paginate(4);
        return view('admin.subcategory.index', compact('subcategories'));;
    }


    public function create()
    {
         return view('admin.subcategory.create');
    }


    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required',
            'category'=>'required'
        ]);

        Subcategory::create(['name'=>$request->name,'categories_id'=>$request->category]);
        return redirect()->route('subCategories.index')->with('success','SubCategory is created successfully.');
    }

    public function show($id)
    {

        $subcategory = SubCategory::find($id);
        return view('admin.subcategory.show',compact('subcategory'));
    }

    
    public function edit($id)
    { 
        $subcategory = SubCategory::find($id);
        return view('admin.subcategory.edit',compact('subcategory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'category'=>'required'
        ]);

        $subcategory = SubCategory::find($id);
        $subcategory->update(['name'=>$request->name,'categories_id'=>$request->category]);

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
        $subcategories = SubCategory::onlyTrashed()->latest()->paginate(4);
        return view('admin.subcategory.trash', compact('subcategories'));
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
