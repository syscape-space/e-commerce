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


    public function Callback()
    { 
        try {
            $socialUser = Socialite::driver('google')->stateless()->user();
           // dd($socialUser->id);
            $user = User::where('google-id', $socialUser->id)->first();
            //dd($user);
            if ($user) {
                Auth::login($user);
                return redirect('/');

            } else {
                $createUser = User::create([
                    'name' => $socialUser->name,
                    'email' => $socialUser->email,
                    'google-id' => $socialUser->id,
                    'password' => encrypt('123456789')
                ]);

                Auth::login($createUser);
                return redirect('/');

            }

        } catch (Exception $exception) {
            dd($exception->getMessage());
        }
    }
    }
 
