<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fcategory extends Model
{
    //

    protected $fillable=[
        'name',
        'caption',
        'user_id',
        'confirmed'

    ];

     //relationship
     public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
     public function posts()
     {
         return $this->belongToMany('App\Post', 'fcategory_id', 'id');
     }


}
