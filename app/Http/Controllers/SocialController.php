<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class SocialController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }


    public function googleCallback()
    {
        try {
              $socialUser=Socialite::driver('google')->stateless()->user();
             // dd($socialUser);
              $user=User::where('google-id',$socialUser->id)->first();
              dd($user);
              if($user){ 
                  dd('1');
                Auth::login($user);
                return redirect('/');
               }  
               else{
               dd($user);
                   $creatUser=User::create([
                    'name'=>$socialUser->name,
                    'email'=>$socialUser->email,
                    'google-id'=>$socialUser->id,
                    'password'=>bcrypt('password'),
                   ]);
                   Auth::login($creatUser);
                   return redirect('/');
               }
            }catch(Exception $exception){
                dd($exception->getMessage());
            }
        }
    }
 
