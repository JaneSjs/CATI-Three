<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchemaController;
use App\Http\Controllers\SystemController;
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

// User Routes
Route::middleware(['auth'])->group(function ()
{
	Route::resource('profile', ProfileController::class);
});

// Admin Routes
Route::middleware(['auth','admin'])->group(function ()
{
	Route::get('admin', [DashboardController::class, 'index']);
	Route::resource('users', UserController::class);
	Route::resource('roles', RoleController::class);
	Route::post('password_reset_link', [UserController::class, 'password_reset_link']);
});

// Project Management Routes
Route::middleware(['auth'])->group(function ()
{
	Route::resource('projects', ProjectController::class);
	Route::middleware('scripter')->get('survey_creator', [ProjectController::class, 'creator']);

	// Route::middleware('scripter')->get('survey_creator_new_tab', [ProjectController::class, 'creator_in_a_new_tab']);

	//Route::post('survey_schema', [SchemaController::class, 'update']);

	Route::resource('surveys', SchemaController::class);
});

Route::middleware('guest')->get('/', [UserController::class, 'login']);
Route::middleware('auth')->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware(['auth','admin'])->group(function ()
{
	Route::get('info', [SystemController::class, 'info']);
	Route::get('adminer', [SystemController::class, 'adminer']);
});
