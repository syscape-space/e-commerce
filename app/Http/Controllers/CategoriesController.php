<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;

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
        $this->validate($request,[
            'name'=>'required|Unique:categories',
            'description'=>'required',
            'image'=>'max:1999|image|nullable',
        ]);

        //Handle file upload
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())).date('Y-m-d H-i-s').'.'. $file->extension();
            $path=$request->file('image')->storeAs('public/category_image',$filename);

        }else {
            $filename='noImage.jpg';
        }
        $category=new Category;
        $category->name=$request->input('name');
        $category->image=$filename;
        $category->description=$request->input('description');
        $category->save();

        return redirect()->route('categories.create')->with('success','category added successfuly');
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
        $this->validate($request,[
            'name'=>['required',Rule::unique('categories')->ignore(request('name'),'name')],
            'description'=>'required',
            'image'=>'max:1999|image|nullable',
        ]);

        //Handle file upload
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())).date('Y-m-d H-i-s').'.'. $file->extension();
            $path=$request->file('image')->storeAs('public/category_image',$filename);
            $category->image=$filename;
        }
        $category->name=$request->input('name');
        $category->description=$request->input('description');
        if($request->hasFile('image')){
            $category->image=$filename;
        }
        $category->save();
        return redirect()->back()->with('success','category edited successfuly');

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
        $categories=Category::onlyTrashed()->where('id',$id)->get();
        foreach($categories as $category){
            if($category->image != 'noImage.jpg'){
                Storage::disk('public')->delete('category_image/'.$category->image);
        }
    }
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
