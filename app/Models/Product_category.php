<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc'];

    //every category has many products
    public function products(){
        return $this->hasMany(Product::class);
    }
}
