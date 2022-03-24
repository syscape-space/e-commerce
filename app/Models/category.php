<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name','image','description'];
    public $timestamp = true;

    // every category has many product
    public function products(){
        return $this->hasMany(Product::class);
    }

    // every category has many subCategories
    public function subCategories(){
        return $this->hasMany(SubCategory::class,'categories_id');
    }
}
