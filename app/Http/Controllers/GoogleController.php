<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();
            // dd($user->avatar);

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/home');
            } else {
                if ($user->avatar) {
                    $newUser = User::create([
                        
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt('anonymous'),
                        'image' => $user->avatar
                    ]);
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'password' => encrypt('anonymous')
                    ]);
                }


                Auth::login($newUser);

                return redirect('/home');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}