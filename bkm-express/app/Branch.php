<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';
        
    public function branch() {
        return $this->hasOne('App\Branch', 'id', 'branch_id');
    }

}
