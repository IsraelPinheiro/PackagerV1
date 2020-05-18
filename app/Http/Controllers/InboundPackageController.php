<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Package;
use Carbon\Carbon;

class InboundPackageController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $packages = Auth::user()->received;
        return view('pages.packages.inbounds.index',compact('packages'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $package = Package::find($id);
        if($package){
            if($package->recipient_id == Auth::user()->id){
                return view('pages.packages.outbounds.show', compact('package'));
            }
            else{
                abort(401);
            }
        }
        else{
            return response()->json(['message' => 'Pacote não encontrado'],404);
        }
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
}
