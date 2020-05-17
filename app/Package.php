<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model{
    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function files(){
        return $this->hasMany('App\File');
    }
    public function sender(){
        return $this->belongsTo('App\User', 'sender_id');
    }
    public function recipient(){
        return $this->belongsTo('App\User', 'recipient_id');
    }
}
