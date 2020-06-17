<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    //
    protected $fillable=[
        'post_id',
        'engaged',
    ];



      //relationship
      public function post()
      {
          return $this->belongsTo('App\Post', 'post_id', 'id');
      }
}
