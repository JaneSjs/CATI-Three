<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InterviewScheduleController;
use App\Http\Controllers\PabxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuotaController;
use App\Http\Controllers\RespondentController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SchemaController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\UserController;
use App\Models\Quota;
use App\Models\Respondent;
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
Route::middleware(['auth','verified'])->group(function ()
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


// Project  Routes
Route::middleware(['auth','verified'])->group(function ()
{
	Route::middleware('scripter')->get('survey_creator', [ProjectController::class, 'creator']);

	// Respondents Import
	Route::get('respondents/import', [RespondentController::class, 'import']);
	Route::post('respondents/xlsx_import', [RespondentController::class, 'xlsx_import']);

	// Survey Results Exports
	Route::get('pdf_export/{id}', [ResultController::class, 'pdf_export']);
	Route::get('xlsx_export/{id}', [ResultController::class, 'xlsx_export']);
	Route::get('csv_export/{id}', [ResultController::class, 'csv_export']);

	// Interview
	Route::get('begin_interview/project/{project_id}/survey/{survey_id}/interview/{interview_id}', [InterviewController::class, 'begin_interview'])->name('begin_interview');
	Route::get('begin_survey/project/{project_id}/survey/{survey_id}/interview/{interview_id}/respondent/{respondent_id}', [InterviewController::class, 'begin_survey'])->name('begin_survey');
	Route::get('coding/interview/{id}', [InterviewController::class, 'coding'])->name('coding');

	// Route::get('update_interview_status/respondent/{respondent_id}/survey/{survey_id}/project/{project_id}/interview/{interview_id}/survey_url/{url}', [RespondentController::class, 'updateRespondentInterviewStatus'])->name('update_interview_status');
	Route::patch('update_interview_status', [RespondentController::class, 'updateRespondentInterviewStatus'])->name('update_interview_status');

	// Export Interviews
	Route::get('interviews_xlsx_export/{id}', [InterviewController::class, 'xlsx_export']);
	// Interview Feedback
	Route::patch('interview_feedback', [InterviewController::class, 'interview_feedback'])->name('interview_feedback');
	// Respondent Feedback
	Route::patch('respondent_feedback', [RespondentController::class, 'respondent_feedback'])->name('respondent_feedback');



	Route::get('search_respondent', [InterviewController::class, 'search_respondent']);
	Route::get('monitor_survey/survey/{id}', [QuotaController::class, 'show'])->name('monitor_survey');
	Route::post('call', [PabxController::class, 'call'])->name('call');

	Route::delete('remove_quota/{schema_id}', [QuotaController::class, 'remove_quota'])->name('remove_quota');

    Route::resource('analytics', AnalyticsController::class);
    Route::resource('interviews', InterviewController::class);
    Route::resource('interview_schedules', InterviewScheduleController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('respondents', RespondentController::class);
    Route::resource('results', ResultController::class);
	Route::resource('surveys', SchemaController::class);
	Route::resource('quotas', QuotaController::class);

});

Route::middleware('guest')->get('/', [UserController::class, 'login']);
Route::middleware(['auth','verified'])->get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
