<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    //
    protected $table = 'batches';
    /**
     * status type 
     * empty = 0
     * ready = 1
     * queued = 2
     * sent = 3
     */
    protected $fillable = ['name','status'];  

    public function subscribers()
    {
        return $this->hasMany('App\Subscribers', 'batch_id','id');
    }
}
