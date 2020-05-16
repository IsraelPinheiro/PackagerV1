<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


if(env('ALLOW_REGISTRATION', false)) {
    Auth::routes();
} else{
    Auth::routes([ 'register' => false ]);
}

Route::get('/', function (){
    if(Auth::check()){
        return redirect()->route('home');
    }
    else{
        return redirect()->route('login');
    }
});

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

//Resource Routes
Route::resource('audit', 'AuditController')->middleware('auth');    //Access Logs and Change Logs
Route::resource('backups', 'BackupController')->middleware('auth');
Route::resource('packages', 'PackageController')->except(['index'])->middleware('auth');
Route::resource('profiles', 'ProfileController')->middleware('auth');
Route::resource('users', 'UserController')->middleware('auth');
Route::resource('inbounds', 'InboundPackagesController')->only(['index'])->middleware('auth');
Route::resource('outbounds', 'OutboundPackagesController')->only(['index'])->middleware('auth');

Route::resource('reports', 'OutboundPackagesController')->only(['index'])->middleware('auth');
Route::resource('dashboard', 'OutboundPackagesController')->only(['index'])->middleware('auth');
Route::resource('config', 'OutboundPackagesController')->only(['index'])->middleware('auth');