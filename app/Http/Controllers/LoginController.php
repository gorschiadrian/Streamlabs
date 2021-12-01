<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login()
    {
        return Socialite::driver('twitch')->scopes(['user:read:follows'])->redirect();
    }

    public function redirect()
    {
        try {
            $apiUser = Socialite::driver('twitch')->user();
        } catch (\Exception $e) {
        }

        if (!$apiUser) {
            abort(401, 'Token is invalid');
        }

        $user = User::where('email', $apiUser->email)->first();
        if (!$user) {
            $user = new User();
            $user->name = $apiUser->name;
            $user->email = $apiUser->email;
            $user->password = 'OAUTH';
            $user->twitch_id = $apiUser->id;
            $user->username = $apiUser->nickname;
            $user->twitch_token = $apiUser->token;
            $user->twitch_refresh_token = $apiUser->refreshToken;
            $user->save();
        } else {
            $user->twitch_token = $apiUser->token;
            $user->twitch_refresh_token = $apiUser->refreshToken;
            $user->save();
        }

        Auth::loginUsingId($user->id);
        return redirect()->route('home');
    }

    public function logOut()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
