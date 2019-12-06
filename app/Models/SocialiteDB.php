<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SocialiteDB extends Model
{
    const TABLE = 'socialites';

    /**
     * {@inheritdoc}
     */
    protected $table = self::TABLE;

    protected $fillable = [
        'email' ,'name','provider_id', 'provider','access_token'
    ];

    protected $appends = [];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
