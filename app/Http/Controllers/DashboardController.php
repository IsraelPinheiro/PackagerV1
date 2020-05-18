<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Carbon\Carbon;
use stdClass;
use App\Profile;
use App\User;
use App\Package;
use App\AccessLog;

class DashboardController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type){
        if($type=="management"){
            $userPermissions = json_decode(Auth::user()->profile->acl_dashboards_management);
            if($userPermissions->read){
                return view('pages.dashboards.management',compact('userPermissions'));
            }
            else{
                abort(401);
            }
        }
        elseif($type=="operational"){
            $userPermissions = json_decode(Auth::user()->profile->acl_dashboards_operational);
            if($userPermissions->read){
                return view('pages.dashboards.operational',compact('userPermissions'));
            }
            else{
                abort(401);
            }
        }
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function charts($type){
        if($type=="management"){
            $userPermissions = json_decode(Auth::user()->profile->acl_dashboards_management);
            if($userPermissions->read){
                $data = new stdClass();
                $data->profileCount = Profile::all()->count();
                $data->profileLabels = Profile::all()->pluck("name");
                $data->profileUsersCount = \DB::table("users")->selectRaw('users.profile_id, count(users.id) as c')->groupBy('users.profile_id')->rightJoin('profiles', 'profiles.id', '=', 'users.profile_id')->get()->pluck('c');
                $data->userActiveCount = User::all()->where("active")->count();
                $data->packageCount = Package::all()->count();
                $data->userActiveLastWeek = AccessLog::all()->where('accessed_at', '>=', Carbon::today()->subdays(7))->unique("user_id")->count();
                return response()->json($data);
            }
            else{
                abort(401);
            }
        }
        elseif($type=="operational"){
            $data = new stdClass();
            $data->memory_usage =  number_format(memory_get_usage() / 1048576, 2);
            $data->memory_peak_usage = number_format(memory_get_peak_usage() / 1048576, 2);
            $data->memory_limit = str_replace("M", "", ini_get('memory_limit'));
            $data->disk_total_space = number_format(disk_total_space("/")/ 1073741824, 2);
            $data->disk_free_space = number_format(disk_free_space("/")/ 1073741824, 2);

            return response()->json($data);
        }
    }
}
