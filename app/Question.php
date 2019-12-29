<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'topic','question','name','status'
    ];
    protected $guarded = ['id','user_id'];

    public  function  user(){
        return $this->belongsTo('App\User');
    }

    public  function  answer(){
        return $this->hasOne('App\Answer');
    }
}
