<?php

namespace App\Http\Livewire;

use App\Models\Category as ModelsCategory;
use App\Models\SubCategory;
use Livewire\Component;

class Category extends Component
{

    public $selectedCategory = null;
    public $selectedSubCategory = null;
    public $subCategories = null;


    public function render()
    {
        return view('livewire.category',[
            'categories' => ModelsCategory::all(),
        ]);
    }

    public function updatedSelectedCategory($category_id)
    {
        $this->subCategories = SubCategory::where('category_id', $category_id)->get();
    }
}
