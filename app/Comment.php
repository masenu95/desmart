<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=[
        'description','user_id','post_id',
    ];

    public function post(){
        return $this->belongsTo('App\Post','post_id','id');
    }

    public function user(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function comment_reactions(){
        return $this->hasMany('App\Comment_Reaction','comment_id','id');
    }
}
