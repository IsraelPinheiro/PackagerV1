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
        $userPermissions = json_decode(Auth::user()->profile->acl_profiles);
        if($userPermissions->create){
            $request->validate([
                'Name' => 'bail|required|min:3|string|unique:profiles,name',
                'Description' => 'bail|nullable|string'
            ]);
            $profile = new Profile;
            $profile->name = $request->Name;
            $profile->description = $request->Description;
            $profile->max_file_size = $request->max_file_size;
            $profile->max_package_size = $request->max_package_size;
            $profile->max_storage_size = $request->max_storage_size;
            $profile->acl_reports_administrative = '{"read":'.($request->reports_administrative_read ? 'true':'false').'}';
            $profile->acl_reports_operational = '{"read":'.($request->reports_operational_read ? 'true':'false').'}';
            $profile->acl_dashboards_management = '{"read":'.($request->dashboards_management_read ? 'true':'false').'}';
            $profile->acl_dashboards_operational = '{"read":'.($request->dashboards_operational_read ? 'true':'false').'}';
            $profile->acl_audit_accessLogs = '{"read":'.($request->audit_access_read ? 'true':'false').', "download":'.($request->audit_access_download ? 'true':'false').'}';
            $profile->acl_audit_changeLogs = '{"read":'.($request->audit_change_read ? 'true':'false').', "download":'.($request->audit_change_download ? 'true':'false').'}';
            $profile->acl_users = '{"create":'.($request->users_create ? 'true':'false').', "read":'.($request->users_read ? 'true':'false').', "update":'.($request->users_update ? 'true':'false').', "delete":'.($request->users_delete ? 'true':'false').'}';
			$profile->acl_profiles = '{"create":'.($request->profiles_create ? 'true':'false').', "read":'.($request->profiles_read ? 'true':'false').', "update":'.($request->profiles_update ? 'true':'false').', "delete":'.($request->profiles_delete ? 'true':'false').'}';
            $profile->acl_backups = '{"create":'.($request->backups_create ? 'true':'false').', "read":'.($request->backups_read ? 'true':'false').', "restore":'.($request->backups_restore ? 'true':'false').', "delete":'.($request->backups_delete ? 'true':'false').'}';
            $profile->acl_config = '{"read":'.($request->config_read ? 'true':'false').', "update":'.($request->config_update ? 'true':'false').'}';
            $profile->created_by = Auth::user()->id;
            $profile->save();
            //TODO: Enable logging
            /*
            if(env('TRACK_CHANGES', true)){
                $log = new ChangeLog;
                $log->user_id = Auth::user()->id;
                $log->loggable_type = 'profile';
                $log->loggable_id = $profile->$id;
                $log->target_action = 'create';
                $log->old_data = null;
                $log->save();
            }*/            
            return response()->json(['message' => 'Usuário Criado'],200);
        }
        else{
            abort(401);
        }
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
        $userPermissions = json_decode(Auth::user()->profile->acl_users);
        if($userPermissions->update){
            $profile = profile::find($id);
            if($profile){
                $request->validate([
                    'Name' => 'bail|required|min:3|string|unique:profiles,name,'.$profile->id,
                    'Description' => 'bail|nullable|string'
                ]);
                if(env('TRACK_CHANGES', true)){
                    $log = new ChangeLog;
                    $log->user_id = Auth::user()->id;
                    $log->loggable_type = 'profile';
                    $log->loggable_id = $id;
                    $log->target_action = 'update';
                    $log->old_data = $profile->toJson();
                    $log->save();
                }
                $profile->name = $request->Name;
                $profile->description = $request->Description;
                $profile->max_file_size = $request->max_file_size;
                $profile->max_package_size = $request->max_package_size;
                $profile->max_storage_size = $request->max_storage_size;
                $profile->acl_reports_administrative = '{"read":'.($request->reports_administrative_read ? 'true':'false').'}';
                $profile->acl_reports_operational = '{"read":'.($request->reports_operational_read ? 'true':'false').'}';
                $profile->acl_dashboards_management = '{"read":'.($request->dashboards_management_read ? 'true':'false').'}';
                $profile->acl_dashboards_operational = '{"read":'.($request->dashboards_operational_read ? 'true':'false').'}';
                $profile->acl_audit_accessLogs = '{"read":'.($request->audit_access_read ? 'true':'false').', "download":'.($request->audit_access_download ? 'true':'false').'}';
                $profile->acl_audit_changeLogs = '{"read":'.($request->audit_change_read ? 'true':'false').', "download":'.($request->audit_change_download ? 'true':'false').'}';
                $profile->acl_users = '{"create":'.($request->users_create ? 'true':'false').', "read":'.($request->users_read ? 'true':'false').', "update":'.($request->users_update ? 'true':'false').', "delete":'.($request->users_delete ? 'true':'false').'}';
                $profile->acl_profiles = '{"create":'.($request->profiles_create ? 'true':'false').', "read":'.($request->profiles_read ? 'true':'false').', "update":'.($request->profiles_update ? 'true':'false').', "delete":'.($request->profiles_delete ? 'true':'false').'}';
                $profile->acl_backups = '{"create":'.($request->backups_create ? 'true':'false').', "read":'.($request->backups_read ? 'true':'false').', "restore":'.($request->backups_restore ? 'true':'false').', "delete":'.($request->backups_delete ? 'true':'false').'}';
                $profile->acl_config = '{"read":'.($request->config_read ? 'true':'false').', "update":'.($request->config_update ? 'true':'false').'}';
                $profile->updated_by = Auth::user()->id;
                $profile->save();
                return response()->json(['level' => 'success','message' => 'Perfil Alterado com Sucesso'],200);
            }
            else{
                return response()->json(['message' => 'Usuário não encontrado'],404);
            }
        }
        else{
            abort(401);
        }
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
                if($profile->users->count()>0){
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
                    $profile->delete();
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


    public function listUsers($id){
        $userPermissions = json_decode(Auth::user()->profile->acl_profiles);
        if($userPermissions->read){
            $profile = Profile::find($id);
            if($profile){
                return view('pages.system.profiles.users', compact('profile'));
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
