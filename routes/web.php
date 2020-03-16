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

Route::get('/home', 'HomeController@index')->name('home');

//Resource Routes
Route::resource('audit', 'AuditController');    //Access Logs and Change Logs
Route::resource('backups', 'BackupController');
Route::resource('packages', 'PackageController')->except(['index']);
Route::resource('profiles', 'ProfileController');
Route::resource('users', 'UserController');
Route::resource('inbounds', 'InboundPackagesController')->only(['index']);
Route::resource('outbounds', 'OutboundPackagesController')->only(['index']);

Route::resource('reports', 'OutboundPackagesController')->only(['index']);
Route::resource('dashboard', 'OutboundPackagesController')->only(['index']);
Route::resource('config', 'OutboundPackagesController')->only(['index']);