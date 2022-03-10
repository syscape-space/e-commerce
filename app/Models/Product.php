<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'desc','SKU','price',
    ];


    //every product belongs to one category
    // public function category(){
    //     return $this->belongsTo(Product_category::class);
    // }

    //every product belongs to one inventory
    // public function inventory(){
    //     return $this->belongsTo(Product_inventory::class);
    // }
}
