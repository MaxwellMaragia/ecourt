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
Route::resource('profile',\App\Http\Controllers\Profile::class);
Route::resource('agents',\App\Http\Controllers\AgentController::class);
Route::resource('cases',\App\Http\Controllers\CaseController::class);
Route::resource('magistrates',\App\Http\Controllers\MagistrateController::class);
Route::resource('partners',\App\Http\Controllers\PartnersController::class);
Route::resource('offences',\App\Http\Controllers\OffenceController::class);
Route::post('change-password',[\App\Http\Controllers\Profile::class, 'changepassword'])->name('changepassword');
Route::post('case/{id}',[\App\Http\Controllers\CaseController::class, 'assignProsecutor'])->name('assignprosecutor');
Route::post('case_outcome/{id}',[\App\Http\Controllers\ProsecutorController::class, 'assignMagistrate'])->name('assignmagistrate');
Route::get('cases_worked_on', [\App\Http\Controllers\ProsecutorController::class,'workedon'])->name('workedon');
Route::get('cases_you_worked_on', [\App\Http\Controllers\MagistrateController::class,'workedon'])->name('workedon-magistrate');
Route::post('select_case_outcome/{id}',[\App\Http\Controllers\MagistrateController::class, 'decideCase'])->name('decidecase');
Route::get('/select_case_outcome/{id}',[\App\Http\Controllers\MagistrateController::class,'IndividualCase']);
Route::get('/view_case/{id}',[\App\Http\Controllers\MagistrateController::class,'viewCase']);
Route::get('/viewcase/{id}',[\App\Http\Controllers\ProsecutorController::class,'viewCase']);
Route::get('/open-case/{id}',[\App\Http\Controllers\DisplayCasesController::class,'viewCase']);
Route::get('/getProsecutor/{id}',[\App\Http\Controllers\CaseController::class,'getProsecutors']);
Route::get('/',[\App\Http\Controllers\ThemeController::class,'home']);

Route::get('changepassword', [\App\Http\Controllers\Profile::class,'create']);
Route::get('active_cases', [\App\Http\Controllers\DisplayCasesController::class,'active']);
Route::get('closed_cases', [\App\Http\Controllers\DisplayCasesController::class,'closed']);
Route::get('/case/{id}',[\App\Http\Controllers\DisplayCasesController::class,'IndividualCase']);
Route::get('/case_outcome/{id}',[\App\Http\Controllers\ProsecutorController::class,'IndividualCase']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/accepts', [App\Http\Controllers\CaseController::class, 'accepts']);
Route::get('/denies', [App\Http\Controllers\CaseController::class, 'denies']);
Route::get('/success', [App\Http\Controllers\CaseController::class, 'success'])->name('success');
Route::post('/search', [App\Http\Controllers\CaseController::class, 'search'])->name('search');
Route::get('/total', [App\Http\Controllers\CaseController::class, 'total'])->name('total');
Route::get('/pending-cases', [App\Http\Controllers\CaseController::class, 'pending'])->name('pending');
Route::get('/closed-cases', [App\Http\Controllers\CaseController::class, 'closed'])->name('closed');
