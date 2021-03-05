<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;

class SocialLoginController extends Controller
{
    //
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();

    }
    public function loginByFacebook(Request $request)
    {
        $user = Socialite::driver('facebook')->user();
        return $user;
    }
}