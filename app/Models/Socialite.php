<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Socialite extends Model
{
    protected $fillable = [
        'email' ,'name','provider_id', 'provider','access_token'
    ];

    protected $appends = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
