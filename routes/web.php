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

//Home
Route::get('/', function (){
    if(Auth::check()){
        return redirect()->route('home');
    }
    else{
        return redirect()->route('login');
    }
});
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
//Audit
Route::get('/audit/{type}', 'AuditController@index')->where("type","access|change")->name('audit.index')->middleware('auth');
Route::get('/audit/{type}/download', 'AuditController@download')->where("type","access|change")->name('audit.download')->middleware('auth');
//Inbound Box
Route::resource('inbounds', 'InboundPackageController')->middleware('auth');
Route::get('/inbounds/download/{package}','InboundPackageController@downloadPackage')->name("inbounds.download.package")->middleware('auth');
Route::get('/inbounds/download/{package}/{file}','InboundPackageController@downloadFile')->name("inbounds.download.file")->middleware('auth');
//Outbound Box
Route::resource('outbounds', 'OutboundPackageController')->middleware('auth');
Route::get('/outbounds/download/{package}','OutboundPackageController@downloadPackage')->name("outbounds.download.package")->middleware('auth');
Route::get('/outbounds/download/{package}/{file}','OutboundPackageController@downloadFile')->name("outbounds.download.file")->middleware('auth');
//Reports
Route::resource('reports', 'ReportController@index')->only(['index'])->middleware('auth');
Route::get('/reports/{type?}/{report?}', 'ReportController@index')->where("type","operational|administrative")->middleware('auth');
//Dashboards
Route::get('/dashboards/{type}', 'DashboardController@index')->where("type","management|operational")->name('dashboards.index')->middleware('auth');
Route::get('/dashboards/{type}/charts', 'DashboardController@charts')->where("type","management|operational")->name('dashboards.charts')->middleware('auth');
//Backups
Route::resource('backups', 'BackupController')->middleware('auth')->except(["store"]);

//User Profiles
Route::resource('profiles', 'ProfileController')->middleware('auth');
Route::get('/profiles/{id}/users','ProfileController@listUsers')->name("profiles.users")->middleware('auth');
//Users
Route::resource('users', 'UserController')->middleware('auth');
//System Config
Route::resource('config', 'ConfigController')->only(['index'])->middleware('auth');
//User Config
Route::get('options/config', 'UserController@promptConfig')->name("user.config")->middleware('auth');
Route::post('options/config', 'UserController@updateConfig')->name("user.config")->middleware('auth');
Route::get('options/password', 'UserController@promptPassword')->name("user.password")->middleware('auth');
Route::post('options/password', 'UserController@updatePassword')->name("user.password")->middleware('auth');
Route::view('options/help', 'pages.options.help')->name("help")->middleware('auth');
Route::view('options/about', 'pages.options.about')->name("about");
//Registration Control
if(env('ALLOW_REGISTRATION', false)) {
    Auth::routes();
}else{
    Auth::routes([ 'register' => false ]);
}