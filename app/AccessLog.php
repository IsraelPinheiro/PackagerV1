<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model{
    const CREATED_AT = 'accessed_at';
    protected $casts = [
        'accessed_at' => 'datetime',
    ];
}
