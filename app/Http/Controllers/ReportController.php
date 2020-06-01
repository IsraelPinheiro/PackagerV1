<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ReportController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type){
        if($type=="administrative"){
            $userPermissions = json_decode(Auth::user()->profile->acl_reports_administrative);
            if($userPermissions->read){
                return view('pages.reports.administrative');
            }
        }
        else if($type=="operational"){
            $userPermissions = json_decode(Auth::user()->profile->acl_reports_operational);
            if($userPermissions->read){
                return view('pages.reports.operational');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report($type, $id){
        if($type=="administrative"){
            $userPermissions = json_decode(Auth::user()->profile->acl_reports_administrative);
            if($userPermissions->read){
                if($id==0){
                    return view('pages.reports.administrative');
                }
                else if($id==1){
                    return view('pages.reports.administrative');
                }
                else if($id==2){
                    return view('pages.reports.administrative');
                }
                else{
                    abort(404);
                } 
            }
        }
        else if($type=="operational"){
            $userPermissions = json_decode(Auth::user()->profile->acl_reports_operational);
            if($userPermissions->read){
                if($id==0){
                    return view('pages.reports.administrative');
                }
                else if($id==1){
                    return view('pages.reports.administrative');
                }
                else{
                    abort(404);
                } 
            }
        }
    }
}