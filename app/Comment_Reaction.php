<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment_Reaction extends Model
{
    //
    protected $fillable =[
        'comment_id','user_id','status',
    ];

    public function comment(){
       return $this->belongsTo('App\Comment','comment_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
