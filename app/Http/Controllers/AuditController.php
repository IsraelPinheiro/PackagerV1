<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Response;
use App\AccessLog;
use App\ChangeLog;

class AuditController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type){
        if($type=="access"){
            $userPermissions = json_decode(Auth::user()->profile->acl_audit_accessLogs);
            if($userPermissions->read){
                $audits = AccessLog::all();
                return view('pages.audit.access',compact('userPermissions','audits'));
            }
            else{
                abort(401);
            }
        }
        elseif($type=="change"){
            $userPermissions = json_decode(Auth::user()->profile->acl_audit_changeLogs);
            if($userPermissions->read){
                $audits = ChangeLog::all();
                return view('pages.audit.change',compact('userPermissions','audits'));
            }
            else{
                abort(401);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function download($type){
        if($type=="access"){
            $userPermissions = json_decode(Auth::user()->profile->acl_audit_accessLogs);
            if($userPermissions->download){
                //TODO: Format Export
                $table = AccessLog::all();
                $output='';
                foreach ($table as $row) {
                    $output .=  implode(";",$row->toArray());
                }
                $headers = array(
                    'Content-Type' => 'text/csv',
                    'Content-Disposition' => 'attachment; filename="acessos.csv"',
                );

                return Response::make(rtrim($output, "\n"), 200, $headers);
            }
            else{
                abort(401);
            }
        }
        elseif($type=="change"){
            $userPermissions = json_decode(Auth::user()->profile->acl_audit_changeLogs);
            if($userPermissions->download){
               //TODO: Format Export
               $table = AccessLog::all();
               $output='';
               foreach ($table as $row) {
                   $output .=  implode(",",$row->toArray());
               }
               $headers = array(
                   'Content-Type' => 'text/csv',
                   'Content-Disposition' => 'attachment; filename="acessos.csv"',
               );

               return Response::make(rtrim($output, "\n"), 200, $headers);
            }
            else{
                abort(401);
            }
        }
    }
}
