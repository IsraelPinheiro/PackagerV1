<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model{
    const CREATED_AT = 'accessed_at';
    public $timestamps = false;
    public function setCreatedAtAttribute($value) { 
        $this->attributes['created_at'] = \Carbon\Carbon::now(); 
    }
    protected $casts = [
        'accessed_at' => 'datetime',
    ];
}
