<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function user()
     {
         return $this->belongsTo('App\User');
     }
     
    public function todos()
    {
        return $this->belongsToMany('App\Todo');
    }
}
