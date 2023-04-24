<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', [UserController::class, 'login']);
Route::get('dashboard', [DashboardController::class, 'index']);

Route::resource('users', UserController::class);
Route::resource('projects', ProjectController::class);

Route::get('survey_creator', [SurveySchemaController::class, 'create']);
Route::post('survey_schema', [SurveySchemaController::class, 'store']);
