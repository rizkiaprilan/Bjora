<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'message'
    ];
    protected $guarded = ['id','sender','receiver'];

    public  function  userSender(){
        return $this->belongsTo('App\User','sender');
    }
    public  function  userReceiver(){
        return $this->belongsTo('App\User','receiver');
    }
}
