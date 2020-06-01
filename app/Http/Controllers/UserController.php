<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\User;
use App\Profile;
use App\ChangeLog;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $userPermissions = json_decode(Auth::user()->profile->acl_users);
        if($userPermissions->read){
            $users = User::all();
            return view('pages.system.users.index',compact('userPermissions','users'));
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
        $userPermissions = json_decode(Auth::user()->profile->acl_users);
        if($userPermissions->create){
            $profiles= Profile::all();
            return view('pages.system.users.new',compact('profiles'));
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
        $userPermissions = json_decode(Auth::user()->profile->acl_users);
        if($userPermissions->create){
            $request->validate([
                'Name' => 'bail|required|min:3|string',
                'Email' => 'bail|required|email|unique:users,email',
                'Profile' => 'bail|required',
                //'Password' => 'bail|required|min:6|confirmed|regex:/^.*(?=.{6,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%&*]).*$/'
            ]);
            $user = new User;
            $user->name = $request->Name;
            $user->email = $request->Email;
            $user->profile_id = $request->Profile;
            if($request->limitsSwitch){
                $user->override_storage_limits = true;
                $user->max_file_size = $request->max_file_size;
                $user->max_package_size = $request->max_package_size;
                $user->max_storage_size = $request->max_storage_size;
            }
            else{
                $user->override_storage_limits = false;
            }
            $user->password = Hash::make($request->Password);
            $user->created_by = Auth::user()->id;
            $user->save();
            
            if(env('TRACK_CHANGES', true)){
                $log = new ChangeLog;
                $log->user_id = Auth::user()->id;
                $log->loggable_type = 'user';
                $log->loggable_id = $user->id;
                $log->target_action = 'create';
                $log->old_data = null;
                $log->save();
            }          
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
        $userPermissions = json_decode(Auth::user()->profile->acl_users);
        if($userPermissions->read){
            $user = User::find($id);
            if($user){
                return view('pages.system.users.show', compact('user'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $userPermissions = json_decode(Auth::user()->profile->acl_users);
        if($userPermissions->update){
            $user = User::find($id);
            $profiles= Profile::all();
            if($user){
                return view('pages.system.users.edit', compact('user', 'profiles'));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $userPermissions = json_decode(Auth::user()->profile->acl_users);
        if($userPermissions->update){
            $user = User::find($id);
            if($user){
                $request->validate([
                    'Name' => 'bail|required|min:3|string',
                    'Email' => 'bail|required|email|unique:users,email,'.$user->id,
                    //'Password' => 'sometimes|nullable|min:6|confirmed|regex:/^.*(?=.{6,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%&*]).*$/'
                ]);
                if(env('TRACK_CHANGES', true)){
                    $log = new ChangeLog;
                    $log->user_id = Auth::user()->id;
                    $log->loggable_type = 'user';
                    $log->loggable_id = $id;
                    $log->target_action = 'update';
                    $log->old_data = $user->toJson();
                    $log->save();
                }
                $user->name = $request->Name;
                $user->email = $request->Email;
                $user->profile_id = $request->Profile;
                $user->active = $request->Status;
                if($request->limitsSwitch){
                    $user->override_storage_limits = true;
                    $user->max_file_size = $request->max_file_size;
                    $user->max_package_size = $request->max_package_size;
                    $user->max_storage_size = $request->max_storage_size;
                }
                else{
                    $user->override_storage_limits = false;
                }
                if($request->Password!=''){
                    $user->password = Hash::make($request->Password);
                }
                $user->updated_by = Auth::user()->id;
                $user->save();
                return response()->json(['level' => 'success','message' => 'Usuário Alterado'],200);
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
        $userPermissions = json_decode(Auth::user()->profile->acl_users);
        if($userPermissions->delete){
            $user = User::find($id);
            if($user){
                if(Auth::user()->id!=$user->id){
                    if(env('TRACK_CHANGES', true)){
                        $log = new ChangeLog;
                        $log->user_id = Auth::user()->id;
                        $log->loggable_type = 'user';
                        $log->loggable_id = $id;
                        $log->target_action = 'delete';
                        $log->old_data = $user->toJson();
                        $log->save();
                    }
                    $user->delete();
                    return response()->json(['level' => 'success','message' => 'Usuário Excluído'],200);
                }
                else{
                    return response()->json(['message' => 'O Usuário atualmente logado não pode ser removido'],403);
                }
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
     * Shows the prompt for the users to update their info.
     *
     * @return \Illuminate\Http\Response
     */
    public function promptConfig(){
        $user = User::find(Auth::user()->id);
        if($user){
            return view('pages.options.config', compact('user'));
        }
        else{
            return response()->json(['message' => 'Usuário não encontrado'],404);
        }
    }

    /**
     * Update the info of the currently logged in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateConfig(Request $request){
        $request->validate([
            'Name' => 'bail|required|min:3|string',
            'Email' => 'bail|required|email|unique:users,email,'.Auth::user()->id,
        ]);
        $user = User::find(Auth::user()->id);
        if(env('TRACK_CHANGES', true)){
            $log = new ChangeLog;
            $log->user_id = Auth::user()->id;
            $log->loggable_type = 'user';
            $log->loggable_id = Auth::user()->id;
            $log->target_action = 'update';
            $log->old_data = $user->toJson();
            $log->save();
        }
        $user->name = $request->Name;
        $user->email = $request->Email;
        $user->save();
        return response()->json(['message' => 'Dados Alterados com Sucesso'],200);
    }

    /**
     * Shows the prompt for password change by the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function promptPassword(){
        return view('pages.options.password');
    }

    /**
     * Update the password of the currently logged in user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request){
        $request->validate([
            //'Password' => 'bail|required|min:6|confirmed|regex:/^.*(?=.{6,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\X])(?=.*[!@#$%&*]).*$/'
        ]);
        $user = User::find(Auth::user()->id);
        if(env('TRACK_CHANGES', true)){
            $log = new ChangeLog;
            $log->user_id = Auth::user()->id;
            $log->loggable_type = 'user';
            $log->loggable_id = Auth::user()->id;
            $log->target_action = 'update';
            $log->old_data = $user->toJson();
            $log->save();
        }
        $user->password = Hash::make($request->Password);
        $user->save();
        return response()->json(['message' => 'Senha Alterada com Sucesso'],200);
    }
}
