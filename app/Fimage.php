<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fimage extends Model
{
    //
      //
      protected $fillable = [
        'name',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
