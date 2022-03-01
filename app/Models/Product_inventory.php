<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_inventory extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];

    //every inventory has one product
    public function product(){
        return $this->hasOne(Product::class);
    }
}
