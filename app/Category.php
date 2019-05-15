<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    
    protected $fillable = ['name','sender_email','reply_to_email'];  

    public function template()
    {
        return $this->belongsToMany('App\Template' , 'category_id');
    }
}
