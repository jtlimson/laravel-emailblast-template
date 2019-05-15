<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unsubscribe extends Model
{
    //
    protected $table = 'unsubscribes';
    
    protected $fillable = ['email','pin','unsubscription'];  
}
