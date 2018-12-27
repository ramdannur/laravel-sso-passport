<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();

        $data['page_title'] = "Dashboard";
        // $data['page_description'] = "Lorem ipsum dolor sit amet";
        
        // dd(Session::get('passport_token'));
        
        return view('admin.dashboard')->with($data);
    }
}
