<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{

    use WithPagination;
    public $sentence;

    public function render()
    {
        $products=Product::where('is_acceptable','!=', NULL)->when($this->sentence,function($query){
            return $query->where('name','LIKE','%'.$this->sentence.'%')->get();
        });
        return view('livewire.search', [
            'products' => $products,
        ]);
    }
}
