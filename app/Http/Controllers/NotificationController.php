<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
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
    //database notification
    public function productNotify(){
        $users=User::find(Auth::user()->id);
        return view('notification')->with('users',$users);
    }

    //to mark as read
    public function toMarkAsRead($id){
        DatabaseNotification::find($id)->markAsRead();
        return redirect('/home/notification')->with('success', 'Notification mark as read');
    }

}
