<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model{
    public function package(){
        return $this->belongsTo('App\File');
    }
}
