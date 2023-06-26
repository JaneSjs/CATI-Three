<?php

use App\Http\Controllers\ProjectApiController;
use App\Http\Controllers\ResultApiController;
use App\Http\Controllers\SchemaApiController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [UserController::class, 'api_login']);

Route::middleware('auth:sanctum')->name('api.')->group(function ()
{
    Route::apiResources([
        'projects' => ProjectApiController::class,
        'surveys' => SchemaApiController::class,
        'results' => ResultApiController::class
    ]);
});