<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relationships
    public function lastAccess(){
        return $this->hasOne('App\AccessLog')->latest();
    }
    public function profile(){
        return $this->belongsTo('App\Profile');
    }
    public function accesses(){
        return $this->hasMany('App\AccessLog');
    }
    public function logs(){
        return $this->morphMany('App\ChangeLog', 'loggable');
    }
    public function reveived(){
        return $this->hasMany('App\Package', 'recipient_id')->whereDate('expires_at', '<=', Carbon::today()->toDateString())->orWhere('expires_at')->orWhereNull('expires_at');
    }
    public function sent(){
        return $this->hasMany('App\Package', 'sender_id');
    }
}
