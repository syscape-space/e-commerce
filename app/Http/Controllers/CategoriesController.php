<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
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

    public function index(Category $category)
    {
        $categories = $category::latest()->paginate(5);

        return view('admin.category.index',compact('categories'));
    }


    public function create()
    {
        return view('admin.category.create');
    }

    public function store(StorecategoryRequest $request)
    {
        $request->validate([
            'name'=>'required|Unique:categories',
            'description'=>'required',
            'image'=>'required'
        ]);

        $path = $request->image->store('public/images');
        $data = $request->all();
        $data['image']=$path;
        Category::create($data);
        return redirect()->route('categories.index')->with('success','New Category has been added successfuly');
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.category.show',compact('category'));

    }

    public function edit($id)
    {
        $category = Category::find($id);
        // if(auth()->user()->id !== $id){
        //     return redirect('Categories')->with('error','sorry You can\'t edit this category');
        // }
        return view('admin.category.edit',compact('category'));

    }

    public function update(UpdatecategoryRequest $request, Category $category)
    {
        $request->validate([
            'name'=>['required',Rule::unique('categories')->ignore(request('name'),'name')],
            'description'=>'required',
        ]);
        if($request->has('image')){
            $path = $request->image->store('public/images');
        } else {
            $path = $category->image;
        }
        $data = $request->all();
        $data['image']=$path;
        $category->update($data);
        return redirect()->route('categories.index')->with(['success'=>'Category has been updated']);
    }

    public function destroy(category $category)
    {
        if($category->image != 'noImage.jpg'){
            Storage::delete('public/categories_image/'.$category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with(['success'=>'Category has been deleted']);
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->latest()->paginate(4);
        return view('admin.category.trash', compact('categories'));
    }

    //soft Delete
    public function softdelete($id)
    {
        $category = Category::find($id)->delete();
         return redirect()->route('categories.index')->with('success', 'category Is Moved To Trash');
    }
    //Hard Delete
    public function hardDelete($id)
    {
        $category = Category::onlyTrashed()->where('id',$id)->forcedelete();
         return redirect()->route('categories.trash')->with('success', 'category Is Deleted Successfully');
    }
    //Back from trash
    public function backFromTrash ($id)
    {
        $task = Category::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->route('categories.index')->with('success', 'category Is Back from trash Successfully');
    }
}
