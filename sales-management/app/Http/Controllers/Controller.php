<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // API Respon Format
    public function formatResponse($code, $msg, $data = "", $error = "",  $more = ""){

        $arrResponse = array();
        $arrResponse['code'] = $code;
        $arrResponse['message'] = $msg;
        
        if($data != ""){
            $arrResponse['data'] = $data;
        }
        
        if($error != ""){
            $arrResponse['error'] = $error;
        }
        
        if($more != ""){
            foreach($more as $key => $value){
                $arrResponse[$key] = $value;
            }
        }

        return $arrResponse;

    }

    function remove_http($url) {
        $disallowed = array('http://', 'https://');
        foreach($disallowed as $d) {
           if(strpos($url, $d) === 0) {
              return str_replace($d, '', $url);
           }
        }
        return $url;
     }

     function getUrlRedirect($isRedirectUrl){
        $source = explode("/", $isRedirectUrl);

        if (substr( $isRedirectUrl, 0, 4 ) == "http") {
            $protocol = $source[0];
            $host = $source[2];
            $target = $isRedirectUrl;
        }else{
            $protocol = 'http://';
            $host = $source[0];
            $target = $protocol.$isRedirectUrl;
        }

        return $target;
     }
     
}
