<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use Carbon\Carbon;
use ZipArchive;
use Storage;

class PackageController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($key){
        $package = Package::where('key',$key)->firstOrFail();
        if($package){
            if(!$package->expires_at->isPast()){
                return view('pages.packages.external', compact('package'));
            }
            else{
                abort(401);
            }
        }
        else{
            abort(404);
        }
    }

    /**
     * Download the specified package from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadPackage($key){
        $package = Package::where('key',$key)->firstOrFail();
        if($package){
            if(!$package->expires_at->isPast()){
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
     * Download the specified file from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function downloadFile($key, $file){
        $package = Package::where('key',$key)->firstOrFail();
        $file = File::find($id);
        if($file && $package){
            if($file->package->key == $package->key){
                if(!$package->expires_at->isPast()){
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
        else{
            return response()->json(['message' => 'Arquivo não encontrado'],404);
        }        
    }
}
