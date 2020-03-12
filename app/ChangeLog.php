<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeLog extends Model{
    const UPDATED_AT = null;
    
    public function loggable(){
        return $this->morphTo();
    }
}
