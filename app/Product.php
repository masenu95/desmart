<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //decleare fillable

    protected $fillable =[
        'title','price','description','location','status','user_id','subcategory_id',
    ];

    public function images()
    {
        return $this->hasMany('App\Image', 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory', 'subcategory_id', 'id');
    }
}
