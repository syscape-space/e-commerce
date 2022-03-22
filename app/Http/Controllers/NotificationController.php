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

    //to mark all as read
    public function toMarkAllAsRead(){
        DatabaseNotification::where('notifiable_id',Auth::user()->id)->get()->markAsRead();
        return redirect('/home/notification')->with('success', 'all Notification mark as read');
    }


    //to mark as read
    public function toMarkAsUnRead($id){
        DatabaseNotification::find($id)->markAsUnRead();
        return redirect('/home/notification')->with('success', 'Notification mark as unread');
    }

    //to mark all as unread
    public function toMarkAllAsUnRead(){
        DatabaseNotification::where('notifiable_id',Auth::user()->id)->get()->markAsUnRead();
        return redirect('/home/notification')->with('success', 'all Notification mark as unread');
    }

    //seen notification
    public function seenNotification(){
        $users=User::find(Auth::user()->id);
        return view('seennotification')->with('users',$users);
    }

    //delete database notification
    public function delete($id){
        $notification=DatabaseNotification::find($id);
        $notification->delete();
        return redirect('/home/notification')->with('success','notification has been removed');
    }

    //delete all database notification
    public function deleteAll(){
        $notification=DatabaseNotification::where('notifiable_id',Auth::user()->id);
        $notification->delete();
        return redirect('/home/notification')->with('success','all notification has been removed');
    }

}
