<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
    	return Socialite::driver($provider)->redirect();
    }
    public function handleProviderCallback($provider)
    {
    	$user = Socialite::driver($provider)->user();

    	//dd($user);
    	/*
		User {#255 ▼
		  +token: "EAAIiyQ172fABAPXMt75rMduWZC6jvRtU5VZA1hWF1Kg4CSn65mPWoprvHt8AyyeVWdc4fsvujvBVprNytrPGKlggJuG3ZA16Xvd91eZAP8FZAcvBRcMUYmIhTUcMNLAZCX7Bsh2to0WGbT79cbcl38JJOYV78MA ▶"
		  +refreshToken: null
		  +expiresIn: "5183997"
		  +id: "397631183924899"
		  +nickname: null
		  +name: "Timor Lang"
		  +email: "atabegruslan@gmail.com"
		  +avatar: "https://graph.facebook.com/v2.8/397631183924899/picture?type=normal"
		  +user: array:6 [▼
		    "name" => "Timor Lang"
		    "email" => "atabegruslan@gmail.com"
		    "gender" => "male"
		    "verified" => true
		    "link" => "https://www.facebook.com/app_scoped_user_id/397631183924899/"
		    "id" => "397631183924899"
		  ]
		  +"avatar_original": "https://graph.facebook.com/v2.8/397631183924899/picture?width=1920"
		  +"profileUrl": "https://www.facebook.com/app_scoped_user_id/397631183924899/"
		}
    	*/

		$data = [
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'type' => $provider,
            'social_id' => $user->getId(),
            'password' => bcrypt('random') // to be improved later
        ];
     
        Auth::login(User::firstOrCreate($data));

        return Redirect::to('/entry');
    }
}
