<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Events\ModelCreated;

class Activity extends Model
{


    protected $table='activity_log';

    public function post_table(){
        return $this->hasOne('App\Models\Post','id','subject_id')->withTrashed();
    }

    public function user(){
        return $this->hasOne('App\Models\User','id','causer_id');
    }

}
