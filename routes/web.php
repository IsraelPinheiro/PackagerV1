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
Route::get('/audit/{type}', 'AuditController@index')->where("type","access|change")->name('audit.index')->middleware('auth');
Route::get('/audit/{type}/download', 'AuditController@download')->where("type","access|change")->name('audit.download')->middleware('auth');
Route::resource('backups', 'BackupController')->middleware('auth');
Route::resource('packages', 'PackageController')->except(['index'])->middleware('auth');
Route::resource('profiles', 'ProfileController')->middleware('auth');
Route::get('/profiles/{id}/users','ProfileController@listUsers')->name("profiles.users")->middleware('auth');
Route::resource('users', 'UserController')->middleware('auth');
Route::resource('inbounds', 'InboundPackagesController')->only(['index'])->middleware('auth');
Route::resource('outbounds', 'OutboundPackagesController')->only(['index'])->middleware('auth');
Route::resource('reports', 'ReportController@index')->only(['index'])->middleware('auth');
Route::get('/reports/{type?}/{report?}', 'ReportController@index')->where("type","operational|administrative")->middleware('auth');
Route::get('/dashboards/{type}', 'DashboardController@index')->where("type","management|operational")->name('dashboards')->middleware('auth');
Route::resource('config', 'OutboundPackagesController')->only(['index'])->middleware('auth');

//Opções
Route::get('options/config', 'UserController@promptConfig')->name("user.config")->middleware('auth');
Route::post('options/config', 'UserController@updateConfig')->name("user.config")->middleware('auth');
Route::get('options/password', 'UserController@promptPassword')->name("user.password")->middleware('auth');
Route::post('options/password', 'UserController@updatePassword')->name("user.password")->middleware('auth');
Route::view('options/help', 'pages.options.help')->name("help")->middleware('auth');
Route::view('options/about', 'pages.options.about')->name("about");