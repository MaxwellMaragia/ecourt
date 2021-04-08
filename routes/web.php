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

Route::resource('stations', \App\Http\Controllers\StationController::class);
Route::resource('courts', \App\Http\Controllers\CourtController::class);
Route::resource('station_admins', \App\Http\Controllers\StationAdminController::class );
Route::resource('court_admins', \App\Http\Controllers\CourtAdminController::class);
Route::resource('profile','Profile');
Route::resource('agents',\App\Http\Controllers\AgentController::class);
Route::resource('cases',\App\Http\Controllers\CaseController::class);
Route::resource('magistrates',\App\Http\Controllers\MagistrateController::class);
Route::resource('offences',\App\Http\Controllers\OffenceController::class);
Route::post('change-password',[\App\Http\Controllers\Profile::class, 'changepassword'])->name('changepassword');
Route::get('/getProsecutor/{id}',[\App\Http\Controllers\CaseController::class,'getProsecutors']);
Route::get('/', function () {
    return view('home');
});

Route::get('changepassword', [\App\Http\Controllers\Profile::class,'create']);
Route::get('active_cases', [\App\Http\Controllers\DisplayCasesController::class,'active']);
Route::get('closed_cases', [\App\Http\Controllers\DisplayCasesController::class,'closed']);
Route::get('/case/{id}',[\App\Http\Controllers\DisplayCasesController::class,'IndividualCase']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/accepts', [App\Http\Controllers\CaseController::class, 'accepts']);
Route::get('/denies', [App\Http\Controllers\CaseController::class, 'denies']);
