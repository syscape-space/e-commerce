<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'categories_id'
    ];

    // each subCategory has many products
    public function products(){
        return $this->hasMany(Product::class, 'sub_categories_id');
    }

    // each SubCategory belongsTo one Category
    public function categories(){
        return $this->belongsTo(SubCategory::class, 'categories_id');
    }
}
