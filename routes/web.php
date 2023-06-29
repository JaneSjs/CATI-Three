<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RespondentController;
use App\Http\Controllers\ResultController;
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

// Dashboard Routes
Route::middleware(['auth'])->group(function ()
{
	Route::get('admin', [DashboardController::class, 'index']);
});

// User Routes
Route::middleware(['auth'])->group(function ()
{
	Route::resource('profile', ProfileController::class);
	Route::resource('users', UserController::class);
	Route::get('agents', [UserController::class, 'agents']);
});

// Admin Routes
Route::middleware(['auth','admin'])->prefix('admin')->group(function ()
{
	
	Route::resource('roles', RoleController::class);
	Route::post('password_reset_link', [UserController::class, 'password_reset_link']);
	Route::get('info', [SystemController::class, 'info']);
});


// Project Management Routes
Route::middleware(['auth'])->group(function ()
{
	Route::resource('projects', ProjectController::class);
	Route::middleware('scripter')->get('survey_creator', [ProjectController::class, 'creator']);

	// Route::middleware('scripter')->get('survey_creator_new_tab', [ProjectController::class, 'creator_in_a_new_tab']);

	//Route::post('survey_schema', [SchemaController::class, 'update']);

	Route::resource('surveys', SchemaController::class);
	Route::resource('results', ResultController::class);
	

    // Respondents Import
	Route::get('respondents/import', [RespondentController::class, 'import']);
	Route::post('respondents/xlsx_import', [RespondentController::class, 'xlsx_import']);

	Route::resource('respondents', RespondentController::class);

	// Survey Results Exports
	Route::get('pdf_export/{id}', [ResultController::class, 'pdf_export']);
	Route::get('xlsx_export/{id}', [ResultController::class, 'xlsx_export']);
	Route::get('csv_export/{id}', [ResultController::class, 'csv_export']);

	//Analytics
	Route::resource('analytics', AnalyticsController::class);
});

Route::middleware('guest')->get('/', [UserController::class, 'login']);
Route::middleware('auth')->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
