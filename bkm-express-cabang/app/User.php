<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cookie;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function getAvatarUrlAttribute(){
        return "http://127.0.0.1/images/default.png";
    }
    
    public function getBkmUser(){
        $curl = curl_init();

        $accessToken = Cookie::get('passport_token');

        curl_setopt_array($curl, array(
            CURLOPT_URL => config("constants.SSO_API_ENDPOINT")."/get-details",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Accept: application/json',
                'Authorization: Bearer '.$accessToken,
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $result = "";

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $result = json_decode($response);
        }

        if($result->message == "Unauthenticated."){
            dd($result);
        }

        return $result->data;
    }
}