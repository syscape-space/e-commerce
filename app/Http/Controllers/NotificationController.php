<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\generalNotifications;

use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //database notification
    public function productNotify(){
        $users=User::find(Auth::user()->id);
        return view('notification')->with('users',$users);
    }

    //to mark as read
    public function toMarkAsRead($id){
        DatabaseNotification::find($id)->markAsRead();
        return redirect('/notification')->with('success', 'Notification mark as read');
    }

    //to mark as read for admin
    public function adminToMarkAsRead($id){
        DatabaseNotification::find($id)->markAsRead();
        return redirect()->route('admin.notifications')->with('success', 'Notification mark as read');
    }

    //to mark all as read
    public function toMarkAllAsRead(){
        DatabaseNotification::where('notifiable_id',Auth::user()->id)->get()->markAsRead();
        return redirect('/notification')->with('success', 'all Notification mark as read');
    }


    //to mark all as read for admin
    public function AdminToMarkAllAsRead(){
        DatabaseNotification::where('notifiable_id',Auth::user()->id)->get()->markAsRead();
        return redirect()->route('admin.notifications')->with('success', 'all Notification mark as read');
    }


    //to mark as read
    public function toMarkAsUnRead($id){
        DatabaseNotification::find($id)->markAsUnRead();
        return redirect('/notification')->with('success', 'Notification mark as unread');
    }

    //to mark as read for admin
    public function adminToMarkAsUnRead($id){
        DatabaseNotification::find($id)->markAsUnRead();
        return redirect()->route('admin.notifications')->with('success', 'Notification mark as unread');
    }
    

    //to mark all as unread
    public function toMarkAllAsUnRead(){
        DatabaseNotification::where('notifiable_id',Auth::user()->id)->get()->markAsUnRead();
        return redirect('/notification')->with('success', 'all Notification mark as unread');
    }


    //to mark all as unread for admin
    public function AdminToMarkAllAsUnRead(){
        DatabaseNotification::where('notifiable_id',Auth::user()->id)->get()->markAsUnRead();
        return redirect()->route('admin.notifications')->with('success', 'all Notification mark as unread');
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
        return redirect('/notification')->with('success','notification has been removed');
    }

    //delete database notification for admin
    public function deleteAdmin($id){
        $notification=DatabaseNotification::find($id);
        $notification->delete();
        return redirect()->route('admin.notifications')->with('success','notification has been removed');
    }

    //delete all database notification
    public function deleteAll(){
        $notification=DatabaseNotification::where('notifiable_id',Auth::user()->id);
        $notification->delete();
        return redirect('/notification')->with('success','all notification has been removed');
    }

    //delete all database notification for admin
    public function adminDeleteAll(){
        $notification=DatabaseNotification::where('notifiable_id',Auth::user()->id);
        $notification->delete();
        return redirect()->route('admin.notifications')->with('success','all notification has been removed');
    }

     public function sendNotification($reciver , $message) 
    {  
        $sender = User::where('id',Auth::id())->first();  
        //$reciver->notify(new generalNotifications($sender,$message));
        Notification::send($reciver,new generalNotifications($sender,$message));

    }

    //Admin notification
    public function adminNotification(){
        $users=User::find(Auth::user()->id);
        return view('admin.notification')->with('users',$users);
    }

    //seen admin notification
    public function seenAdminNotification(){
        $users=User::find(Auth::user()->id);
        return view('admin.seennotification')->with('users',$users);
    }
}
