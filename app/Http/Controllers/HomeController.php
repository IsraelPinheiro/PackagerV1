<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class HomeController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    function formatBytes($size, $precision = 2){
        $base = log($size, 1024);
        $suffixes = array('', 'Kb', 'Mb', 'Gb', 'Tb');
        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $sent = Auth::user()->sent;
        $received = Auth::user()->sent;
        $usedSpace = 0;
        foreach ($sent as $package) {
            $usedSpace += $package->files->sum("size");
        }
        $usedSpace = self::formatBytes($usedSpace);
        return view('pages.home',compact('sent', 'received', 'usedSpace'));
    }
}
