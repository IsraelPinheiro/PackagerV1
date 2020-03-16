<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Profile;
use App\ChangeLog;

class ProfileController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $userPermissions = json_decode(Auth::user()->profile->acl_profiles);
        if($userPermissions->read){
            $profiles = Profile::all();
            return view('pages.system.profiles.index',compact('userPermissions','profiles'));
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
        $userPermissions = json_decode(Auth::user()->profile->acl_profiles);
        if($userPermissions->create){
            return view('pages.system.profiles.new');
        }
        else{
            abort(401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //TODO: Add store logic
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $userPermissions = json_decode(Auth::user()->profile->acl_profiles);
        if($userPermissions->read){
            $profile = Profile::find($id);
            if($profile){
                return view('pages.system.profiles.show', compact('profile'));
            }
            else{
                return response()->json(['message' => 'Perfil de Usuário não encontrado'],404);
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
        $userPermissions = json_decode(Auth::user()->profile->acl_profiles);
        if($userPermissions->update){
            $profile = Profile::find($id);
            if($profile){
                return view('pages.system.profiles.edit', compact('profile'));
            }
            else{
                return response()->json(['message' => 'Perfil de Usuário não encontrado'],404);
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
        //TODO: Add Update logic
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $userPermissions = json_decode(Auth::user()->profile->acl_profiles);
        if($userPermissions->delete){
            $profile = Profile::find($id);
            if($profile){
                if($profile->usuarios->count()>0){
                    return response()->json(['level' => 'error','message' => 'Este Perfíl possúi usuários atribuídos'],403);
                }
                else{
                    if(env('TRACK_CHANGES', true)){
                        $log = new ChangeLog;
                        $log->user_id = Auth::user()->id;
                        $log->loggable_type = 'profile';
                        $log->loggable_id = $id;
                        $log->target_action = 'delete';
                        $log->old_data = $profile->toJson();
                        $log->save();
                    }
                    $perfil->delete();
                    return response()->json(['level' => 'success','message' => 'Perfil de Usuário Excluído'],200);
                }
            }
            else{
                return response()->json(['message' => 'Perfil de Usuário não encontrado'],404);
            }
        }
        else{
            abort(401);
        }
    }
}
