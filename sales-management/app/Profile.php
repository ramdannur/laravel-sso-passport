<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'phone', 'address', 'photo'
    ];
    
    public function getAvatarUrlAttribute(){
        $avatar =  $this->attributes['photo'] ?: 'default.png';

        $path = config('constants.PATH.UPLOADS.USERS');

        return asset($path.$avatar);

    }
}
