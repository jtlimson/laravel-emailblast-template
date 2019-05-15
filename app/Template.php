<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    //
    protected $table = 'templates';
    protected $fillable = ['title','category_id','body'];  

    public function category()
    {
        return $this->hasOne('App\Category', 'id','category_id');
    }
}
