<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function list(){
        $users = User::get();
        return view('admin.user.index',compact('users'));
    }
}
