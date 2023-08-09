<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class FacebookController extends Controller
{
    public function redirect()
    {
        // return Socialite::driver('facebook')->redirect();
    }

    public function callback()
    {
        // $facebookUser = Socialite::driver('facebook')->user();
        // dd($facebookUser);

        // if($facebookUser){
        //     $facebookUser = Socialite::driver('facebook')->stateless()->user(); //kệ nó
        // }
        // $user = User::where('facebook_user_id', $facebookUser->id)->first();
        // if($user){
        //     $user->name = $facebookUser->name;
        //     $user->save();
        // }else{
        //     $user = User::create([
        //         'email' => $facebookUser->email,
        //         'name' => $facebookUser->name,
        //         'facebook_user_id' => $googleUser->id,
        //         'password' =>Hash::make('password'.'@'.$facebookUser->id),
        //     ]);
        // }

        // Auth::login($user);
        // return redirect()->route('client.home.list');

    }
}
