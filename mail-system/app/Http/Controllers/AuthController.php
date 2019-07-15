<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Cookie;
use Session;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function signin(Request $request)
    {
        return redirect("/home");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function setSession(Request $request, $id)
    {
        $accessToken = $id;
        $data = array();
        $isHasRemember = "on";
        $user_id = User::first()->id;

        $user = User::firstOrCreate([
            'name' => 'Dummy User',
            'email' => 'cyberlabs.dev@gmail.com',
            'password' => 'developers'
        ]);

        Auth::loginUsingId($user_id, $isHasRemember);

        Cookie::queue('passport_token', $accessToken, 2628000);
    }

    public function logout(Request $request)
    {
        $accessToken = Cookie::get('passport_token');

		Auth::logout();
        Session::flush();
        Cookie::queue(Cookie::forget('passport_token'));

        $this->curl_get(config("constants.SSO_API_ENDPOINT")."/logout", $accessToken);
        
        return redirect('/');
    }

    
}
