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
        elseif(auth()->user()->role == 'vendor'){
            return redirect()->route('vendor.dashboard');
        }
        return redirect()->route('frontend');
        
    }
    public function dashboard()
    {
        if(auth()->user()->role == 'admin'){
        return view('admin.layouts.main');
        }
        else{
            return redirect()->route('frontend')->with('success','you are not admin');
        }
    }

    public function vendorDashboard()
    {
        if(auth()->user()->role == 'vendor'){
            return view('vendor.layouts.main');
        }
        else{
            return redirect()->route('frontend')->with('success','you are not vendor');
        }
    }
}
