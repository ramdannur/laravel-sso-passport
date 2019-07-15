<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Cookie;

class PassportController extends Controller
{

    public $successStatus = 200;
 
   /**
    * details api
    *
    * @return \Illuminate\Http\Response
    */
 
   public function getDetails()
   {
 
        $code = 200;
        $msg = __('success');

        try {

            $user = Auth::user();
            $data = array();
            $data['id_user'] = $user->id;
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['phone'] = $user->profile->phone;
            $data['photo'] = $user->profile->avatarUrl;

        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $code = 400;
            $data = (object) array();
        }

        return response()->json($this->formatResponse($code, $msg, $data), $this->successStatus);
 
   }

   public function logout()
   {
 
       $user = Auth::user()->token()->delete();
 
       return response()->json(['data' => $user], $this->successStatus);
 
   }

}
