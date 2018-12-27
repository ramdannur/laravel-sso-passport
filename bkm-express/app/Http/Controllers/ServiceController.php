<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use Session;
use Auth;

class ServiceController extends Controller
{
    public function redirect(Request $request){
        $data = array();

        $urlGet = $request->continue;
        
        $accessToken = Cookie::get('passport_token');

        if(empty($urlGet)){
            $redirectUrl = "admin/dashboard";
        }else{
            $redirectUrl = $urlGet;
        }

        $data['redirect'] = $redirectUrl;
        $data['host'] = array(
            "http://127.0.0.2/session/".$accessToken
        );

        return view('redirect')->with($data);
    }


    public function logout(Request $request){
        $data = array();

        $urlGet = $request->continue;
        
        $accessToken = Cookie::get('passport_token');

        if(empty($urlGet)){
            $redirectUrl = "login";
        }else{
            $redirectUrl = $urlGet;
        }

        $data['redirect'] = $redirectUrl;

        $data['host'] = array(
            "http://127.0.0.2/logout/"
        );

        Auth::logout();
        Session::flush();
        Cookie::queue(Cookie::forget('passport_token'));

        return view('redirect')->with($data);
    }

}
