<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','image','description','price','vendor_id','categories_id','sub_categories_id',
    ];


    // every product belongs to one category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // every product belongs to one inventory
    public function subCategory(){
        return $this->belongsTo(SubCategory::class);
    }

    // every product belongs to one vendor
    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }
}
