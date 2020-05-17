<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type){
        if($type=="management"){
            
        }
        elseif($type=="operational"){

        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function download($type){
        if($type=="management"){
            
        }
        elseif($type=="operational"){

        }
    }
}
