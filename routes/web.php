<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\ConverterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DpiaController;
use App\Http\Controllers\ExportedFileController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\InterviewScheduleController;
use App\Http\Controllers\PabxController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuotaController;
use App\Http\Controllers\ReportController;
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

// Auth Routes
Route::middleware(['auth'])->group(function () {
    Route::get('admin', [DashboardController::class, 'index']);
    Route::resource('profiles', ProfileController::class);
});

// Verified Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('search_users', [UserController::class, 'search']);
    Route::patch('reset_ext_no', [UserController::class, 'resetExtenNo'])->name('reset_ext_no');
    Route::post('search_interviews', [SchemaController::class, 'searchInterviews']);

    Route::resource('users', UserController::class);
    Route::get('attendance_list/project/{id}', [ProjectController::class, 'attendanceList'])->name('attendance_list');

    Route::get('clients', [UserController::class, 'clients'])->name('clients');
    Route::get('interviewers', [UserController::class, 'interviewers'])->name('interviewers');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::resource('roles', RoleController::class);
    Route::post('password_reset_link', [UserController::class, 'password_reset_link']);
    Route::get('info', [SystemController::class, 'info']);
});


// Project  Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Search Projects Route
    Route::get('search_projects', [ProjectController::class, 'search_projects']);
    // Assign Users To Project Route
    Route::patch('projects.assign_more_users', [ProjectController::class, 'assignUsers'])->name('projects.assign_more_users');
    Route::put('projects.assign_specific_users', [ProjectController::class, 'assignUsers'])->name('projects.assign_specific_users');

    Route::middleware('scripter')->get('survey_creator', [ProjectController::class, 'creator']);

    // Respondents Import
    Route::get('respondents/import', [RespondentController::class, 'import']);
    Route::post('respondents/xlsx_import', [RespondentController::class, 'xlsx_import']);
    // Respondents Export
    Route::post('respondents/export', [RespondentController::class, 'export'])->name('respondents.export');

    // Survey Results Exports
    Route::get('pdf_export/{id}', [ResultController::class, 'pdf_export']);
    Route::get('xlsx_export/{id}', [ResultController::class, 'xlsx_export']);
    Route::get('xlsx_sheets_export/{id}', [ResultController::class, 'xlsx_sheets_export']);
    Route::get('csv_export/{id}', [ResultController::class, 'csv_export']);
    Route::post('json_export', [ResultController::class, 'json_export'])->name('json_export');
    Route::get('json_export_all_data/{id}', [ResultController::class, 'jsonExportAllData'])->name('json_export_all_data');
    Route::get('xml_export/{id}', [ResultController::class, 'xml_export'])->name('xml_export');
    Route::get('exported_files/{schemaId}', [ExportedFileController::class, 'exported_files'])->name('exported_files');
    Route::get('download_exported_files/{fileName}', [ExportedFileController::class, 'download_exported_files'])->name('download_exported_files');



    // Interview
    Route::get('begin_interview/project/{project_id}/survey/{survey_id}/interview/{interview_id}', [InterviewController::class, 'begin_interview'])->name('begin_interview');
    Route::get('begin_survey/project/{project_id}/survey/{survey_id}/interview/{interview_id}/respondent/{respondent_id}', [InterviewController::class, 'begin_survey'])->name('begin_survey');

    // Route::get('update_interview_status/respondent/{respondent_id}/survey/{survey_id}/project/{project_id}/interview/{interview_id}/survey_url/{url}', [RespondentController::class, 'updateRespondentInterviewStatus'])->name('update_interview_status');
    Route::patch('update_interview_status', [RespondentController::class, 'updateRespondentInterviewStatus'])->name('update_interview_status');

    // Export Interviews
    Route::post('interviews_xlsx_export', [InterviewController::class, 'xlsx_export'])->name('interviews_xlsx_export');
    // Interview Feedback
    Route::patch('interview_feedback', [InterviewController::class, 'interview_feedback'])->name('interview_feedback');
    // Respondent Feedback
    Route::patch('respondent_feedback', [RespondentController::class, 'respondent_feedback'])->name('respondent_feedback');

    // Extra Respondents routes
    Route::get('search_respondents', [RespondentController::class, 'search_respondents']);

    Route::patch('update_respondent', [RespondentController::class, 'updateRespondent'])->name('update_respondent');


    Route::get('find_respondent', [InterviewController::class, 'find_respondent']);
    Route::get('search_respondent', [InterviewController::class, 'search_respondent']);

    Route::get('project_survey_respondents/{project_id}/{survey_id}', [RespondentController::class, 'project_survey_respondents'])->name('project_survey_respondents');
    Route::get('soft_deleted_respondents/{project_id}/{survey_id}', [RespondentController::class, 'softDeletedRespondents'])->name('soft_deleted_respondents');

    Route::delete('bulk_soft_delete_respondents', [RespondentController::class, 'bulkSoftDelete'])->name('bulk_soft_delete_respondents');
    Route::delete('bulk_permanent_delete_respondents', [RespondentController::class, 'bulkPermanentDelete'])->name('bulk_permanent_delete_respondents');
    Route::patch('restore_respondents', [RespondentController::class, 'restoreRespondents'])->name('restore_respondents');

    Route::patch('unlock_respondents', [RespondentController::class, 'unlockRespondents'])->name('unlock_respondents');
    Route::patch('transfer_respondents', [RespondentController::class, 'tranferRespondents'])->name('transfer_respondents');


    Route::get('operations/survey/{id}', [QuotaController::class, 'show'])->name('operations');
    Route::post('call', [PabxController::class, 'call'])->name('call');

    Route::delete('remove_quota/{schema_id}', [QuotaController::class, 'remove_quota'])->name('remove_quota');

    // Project Performance Reports
    Route::get('interviewers_project_report/{projectId}', [ReportController::class, 'interviewers_project'])->name('interviewers_project_report');
    Route::get('qcs_project_report/{projectId}', [ReportController::class, 'qcs_project_report'])->name('qcs_project_report');

    // File Converters
    Route::post('jsonToCsv', [ConverterController::class, 'jsonToCsv'])->name('jsonToCsv');

    Route::resource('analytics', AnalyticsController::class);
    Route::resource('applicants', ApplicantController::class);
    Route::resource('converters', ConverterController::class);
    Route::resource('dpias', DpiaController::class);
    Route::resource('exported_files', ExportedFileController::class);
    Route::resource('interviews', InterviewController::class);
    Route::resource('interview_schedules', InterviewScheduleController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('reports', ReportController::class);
    Route::resource('respondents', RespondentController::class);
    Route::resource('results', ResultController::class);
    Route::resource('surveys', SchemaController::class);
    Route::resource('quotas', QuotaController::class);
});

Route::middleware('guest')->get('/', [UserController::class, 'login']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('interviews_dashboard/project/{id}', [DashboardController::class, 'interviews_dashboard'])->name('interviews_dashboard');

    Route::get('analytics_new/{id}', [AnalyticsController::class, 'analytics_new'])->name('analytics_new');
});