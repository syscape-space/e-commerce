<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'is_active',
         
    ];
    public $timestamp = true;

    public function products(){
        return $this->hasMany(Product::class, 'vendor_id');
    }


}
