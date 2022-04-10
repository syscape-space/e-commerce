<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*
        $user=User::find(Auth::user()->id);
        return redirect()->route('frontend')->with('user', $user);
        */

        //dd(auth()->user()->role);
        if(auth()->user()->role == 'admin'){
            return redirect()->route('dashboard');
        } 
        return redirect()->route('frontend');
        
    }
    public function dashboard()
    {
        return view('admin.layouts.main');
    }
}
