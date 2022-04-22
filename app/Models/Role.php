<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;
use App\Models\Role;

class Role extends LaratrustRole
{
    public $guarded = [];

protected $fillable = [
        'name',
        'display_name',
        'description',
        
    ];


    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
