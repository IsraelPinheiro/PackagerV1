<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Package;
use Carbon\Carbon;
use App\File;
use App\ChangeLog;

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
                $package->new = false;
                $package->save();
                return view('pages.packages.inbounds.show', compact('package'));
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadPackage($id){
        $package = Package::find($id);
        if($package){
            $package->new = false;
            $package->save();
            if($package->recipient_id == Auth::user()->id){
                $tempFile = 'temp/'.md5(Carbon::now()).'.zip';
                $zip = new ZipArchive();
                if($zip->open(public_path($tempFile), ZipArchive::CREATE | ZipArchive::OVERWRITE)){
                    foreach ($package->files as $file) {
                        $zip->addFile(str_replace("\\", "/",Storage::disk('local')->path($file->file)),$file->originalName);
                    }
                    if($zip->close()){
                        return response()->download(public_path($tempFile), $package->title.'.zip');
                    }
                }
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
    public function downloadFile($id){
        $file = File::find($id);
        if($file){
            if($file->package->recipient_id == Auth::user()->id){
                return Storage::download($file->file, $file->originalName);
            }
            else{
                abort(401);
            }
        }
        else{
            return response()->json(['message' => 'Arquivo não encontrado'],404);
        }        
    }
}
