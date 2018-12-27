<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;

class PublicController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        
        // Cookie::queue(Cookie::forget('test'));

        return view('welcome')->with($data);
    }

}
