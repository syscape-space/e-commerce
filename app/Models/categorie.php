<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    use HasFactory;

    protected $fillable = ['id','name','image','description','created_at','deleted_at','modified_at'];
    public $timestamp = true;
}
