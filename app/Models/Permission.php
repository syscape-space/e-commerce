<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    } 
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
