<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'name','image','description','price','vendor_id','category_id','subCategory_id',
    ];


    // every product belongs to one category
    public function category(){
        return $this->belongsTo(category::class,'category_id');
    }

    // every product belongs to one inventory
    public function subCategory(){
        return $this->belongsTo(SubCategory::class,'subCategory_id');
    }

    // every product belongs to one vendor
    public function vendor(){
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}
