<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    //
    protected $fillable=[
        'name',
        'user_id',
        'confirmed',
        'category_id',
    ];

    //relationship

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

}
