<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = 'delivery';
        
    public function branch() {
        return $this->hasOne('App\Branch', 'id', 'branch_id');
    }

    public function unit() {
        return $this->hasMany('App\Unit', 'delivery_id', 'id');
    }

}
