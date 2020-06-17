<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable=[
        'title',
        'description',
        'user_id',
        'pinned',
        'status',
        'fcategory_id'
    ];
    //relationship
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function fcategory(){
        return $this->belongsTo('App\Fcategory','fcategory_id','id');
    }
    public function comments(){
        return $this->hasMany('App\Comment','post_id','id');
    }
    public function trend(){
        return $this->hasOne('App\Trend','post_id','id');
    }

    public function reactions(){
        return $this->hasMany('App\Reaction','post_id','id');
    }

    public function fimages()
    {
        return $this->hasMany('App\FImage', 'post_id', 'id');
    }
}
