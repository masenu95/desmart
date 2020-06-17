<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //decleare fillable
    protected $fillable=[
        'name',
        'confirmed',
        'user_id'

    ];

    //relationship
    public function subcategories()
        {
            return $this->hasMany('App\Subcategory', 'category_id', 'id');
        }

    public function user()
      {
          return $this->belongsTo('App\User', 'user_id', 'id');
      }

}
