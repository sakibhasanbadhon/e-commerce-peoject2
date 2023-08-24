<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FFI\Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;


class SocialController extends Controller
{

        // Socialite login with google

        public function redirectToGoogle(){
            return Socialite::driver('google')->redirect();
        }

        public function redirectToGoogleCallback(){
            try{
                $user = Socialite::driver('google')->user();
                $findUser = User::where('email',$user->email)->first();
                if (!$findUser) {
                    $findUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'password' => "12345678",
                        'is_admin' => 2,
                    ]);
                }

                session()->put('id',$findUser->id);
                session()->put('is_admin',$findUser->is_admin);
                Auth::login($findUser, true);
                return redirect('/');


            }catch(Exception $object){
                dd($object->getMessage());
            }
        }


    public function redirectToFacebook()    {
        return Socialite::driver('facebook')->redirect();
    }

    // public function redirectToFacebookCallback()
    // {
    //     try {

    //         $user = Socialite::driver('facebook')->stateless()->user();
    //         $existingUser = User::where('fb_id', $user->id)->first();

    //         if (!$existingUser) {
    //             $existingUser = User::create([
    //                 'name' => $user->name,
    //                 'email' => $user->email,
    //                 'password' => "12345678",
    //                 'is_admin' => 2,
    //             ]);
    //         }

    //         Auth::login($existingUser);
    //         return redirect('/');


    //     } catch (\Throwable $th) {
    //       throw $th;
    //    }
    // }



}


