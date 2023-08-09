<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();
        if($googleUser){
            $googleUser = Socialite::driver('google')->stateless()->user(); //kệ nó
        }
        $user = User::where('google_user_id', $googleUser->id)->first();
        if($user){
            $user->name = $googleUser->name;
            $user->save();
        }else{
            $user = User::create([
                'email' => $googleUser->email,
                'name' => $googleUser->name,
                'google_user_id' => $googleUser->id,
                'password' =>Hash::make('password'.'@'.$googleUser->id),
            ]);
        }

        Auth::login($user);
        return redirect()->route('client.home.list');

    }
}
