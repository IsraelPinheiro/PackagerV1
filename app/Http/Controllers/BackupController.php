<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Auth;
use Config;
use App\Backup;

class BackupController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $userPermissions = json_decode(Auth::user()->profile->acl_backups);
        if($userPermissions->read){
            $backups = Backup::all();
            return view('pages.system.backups.index',compact('userPermissions','backups'));
        }
        else{
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        //
    }

    /**
     * Run the backup script
     *
     * @return \Illuminate\Http\Response
     */
    public function backup(){
        $host = Config("database.connections.".Config("database.default").".host");
        $database = Config("database.connections.".Config("database.default").".database");
        $user = Config("database.connections.".Config("database.default").".username");
        $password = Config("database.connections.".Config("database.default").".password");

        $process = new Process(["python",resource_path('python\pybackup.py'),$host,$user,$password,$database]);
        $process->run();
        dd($process);
        // executes after the command finishes
        if (!$process->isSuccessful()) {
            return new ProcessFailedException($process);
        }
        else{
            return True;
        }
    }
}
