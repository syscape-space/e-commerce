<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name','user_id','logo',
    ];

    //every brand has many products
    public function products(){
        return $this->hasMany(Product::class);
    }

    //every brand belong to one user
    public function vendor(){
        return $this->belongsTo(User::class,'vendor_id');
    }
}
