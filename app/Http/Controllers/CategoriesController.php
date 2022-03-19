<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorecategoryRequest;
use App\Http\Requests\UpdatecategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
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
    public function index(Category $category)
    {
        $category = $category::latest()->paginate(5);

        return view('categories.index',compact('category'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecategoryRequest $request)
    {
        if($request->hasFile('image')){
            $file=$request->file('image');
            $filename=md5(file_get_contents($file->getRealPath())) . $file->extension();
            $path=$request->file('image')->storeAs('public/products_image',$filename);

        }else {
            $filename='noImage.jpg';
        }
        Category::create($request->only([
            'name','description',
        ]));

        return redirect()->route('Categories.index')->with('success','New Category has been added successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return view('categories.show',compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        // if(auth()->user()->id !== $id){
        //     return redirect('Categories')->with('error','sorry You can\'t edit this category');
        // }
        return view('Categories.edit',compact('category'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecategoryRequest $request, category $category,$id)
    {
        Category::find($id)->update($request->all());
        return redirect('Categories')->with(['success'=>'Category has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(category $category)
    {
        if($category->image != 'noImage.jpg'){
            Storage::delete('public/categories_image/'.$category->image);
        }
        $category->delete();
        return redirect('Categories.index')->with(['success'=>'Category has been deleted']);
    }

    public function trash()
    {
        $category = Category::onlyTrashed()->latest()->paginate(4);
        return view('Categories.trash', compact('category'));
    }

    //soft Delete
    public function softdelete($id)
    {
        $category = Category::find($id)->delete();
         return redirect()->route('Categories.index')->with('success', 'category Is Moved To Trash');
    }
    //Hard Delete
    public function hardDelete($id)
    {
        $category = Category::onlyTrashed()->where('id',$id)->forcedelete();
         return redirect()->route('Categories.trash')->with('success', 'category Is Deleted Successfully');
    }
    //Back from trash
    public function backFromTrash ($id)
    {
        $task = Category::onlyTrashed()->where('id',$id)->first()->restore();
         return redirect()->route('Categories.index')->with('success', 'category Is Back from trash Successfully');
    }
}
