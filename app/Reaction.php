<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reaction extends Model
{
    //
    protected $fillable =[
        'post_id','user_id','status',
    ];

    public function post(){
       return $this->belongsTo('App\Post','post_id','id');
    }
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
