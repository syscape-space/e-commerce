<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\SendNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class SendEmailNotificationController extends Controller
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
    //send email to users page
    public function sendEmailToUsers(){
        return view('sendnotification');
    }


    //Send email to all users
    public function sendEmailToAllUsers(Request $request)
    {
        $users=User::all();
        
        $data=[
            'head'=>$request->head,
            'body'=>$request->body,
            'urlaction'=>$request->urlaction,
        ];
        Notification::send($users,new SendNotification($data));
        return redirect('/send.email')->with('success','Email sends successfuly');
    }
}
