<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'city',
        'state',
        'country',
         'zipcode',
         'is_active',
         'created_by',
         

    
    ];
    public $timestamp = true;


}
