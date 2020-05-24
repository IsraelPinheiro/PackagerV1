<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Auth;
use Config;
use Storage;
use App\Backup;
use App\ChangeLog;

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
        $host = Config("database.connections.".Config("database.default").".host");
        $database = Config("database.connections.".Config("database.default").".database");
        $user = Config("database.connections.".Config("database.default").".username");
        $password = Config("database.connections.".Config("database.default").".password");
        $process = new Process(["python",resource_path('python\pybackup.py'),$host,$user,$password,$database]);
        $process->run();
        dd($process);
        //Executes after the command finishes
        if (!$process->isSuccessful()) {
            return new ProcessFailedException($process);
        }
        else{
            return True;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $userPermissions = json_decode(Auth::user()->profile->acl_backups);
        if($userPermissions->read){
            $backup = Backup::find($id);
            if($backup){
                return view('pages.system.backups.show', compact('backup'));
            }
            else{
                return response()->json(['message' => 'Backup não encontrado'],404);
            }
        }
        else{
            abort(401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $userPermissions = json_decode(Auth::user()->profile->acl_backups);
        if($userPermissions->download){
            $backup = Backup::find($id);
            if($backup){
                return Storage::download($backup->file);
                //return response()->download("/".$backup->file);
            }
            else{
                return response()->json(['message' => 'Backup não encontrado'],404);
            }
        }
        else{
            abort(401);
        }
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
        $userPermissions = json_decode(Auth::user()->profile->acl_backups);
        if($userPermissions->delete){
            $backup = Backup::find($id);
            if($backup){
                if(env('TRACK_CHANGES', true)){
                    $log = new ChangeLog;
                    $log->user_id = Auth::user()->id;
                    $log->loggable_type = 'Backup';
                    $log->loggable_id = $id;
                    $log->target_action = 'delete';
                    $log->old_data = $backup->toJson();
                    $log->save();
                }
                //TODO: Delete Backup File
                $backup->delete();
                return response()->json(['level' => 'success','message' => 'Backup Excluído'],200);
            }
            else{
                return response()->json(['message' => 'Backup Não Encontrado'],404);
            }
        }
        else{
            abort(401);
        }
    }
}
