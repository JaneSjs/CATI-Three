<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SurveySchemaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// User Management Routes
Route::middleware(['auth','admin'])->group(function ()
{
	Route::get('admin', [DashboardController::class, 'index']);
	Route::resource('users', UserController::class);
	Route::resource('roles', RoleController::class);
});

// Project Management Routes
Route::middleware(['auth'])->group(function ()
{
	Route::resource('projects', ProjectController::class);
	Route::middleware('scripter')->get('survey_creator', [SurveySchemaController::class, 'create']);
	Route::post('survey_schema', [SurveySchemaController::class, 'store']);
});

Route::get('/', [UserController::class, 'login']);
Route::middleware('auth')->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
