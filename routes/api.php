<?php

use App\Http\Controllers\AttachedFileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssuesPerSprintController;
use App\Http\Controllers\IssueTypeController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\UsersPerProjectController;
use App\Http\Controllers\WorkflowController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', LoginController::class);
Route::post('register', RegisterController::class);

//User information
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Companies routes
Route::middleware('auth:sanctum')->controller(CompanyController::class)->prefix('companies')->group(function() {
    Route::get('/', 'index');
});

//Lines routes
Route::middleware('auth:sanctum')->controller(LineController::class)->prefix('lines')->group(function() {
    Route::get('/', 'index');
});

//project types routes
Route::middleware('auth:sanctum')->controller(ProjectTypeController::class)->prefix('project-types')->group(function(){
    Route::get('/', 'index');
});

//projects routes
Route::middleware('auth:sanctum')->controller(ProjectController::class)->prefix('projects')->group(function(){
    Route::get('/', 'index');
    Route::get('/{key}/{uuid}', 'project');

    Route::post('/', 'store');
});

//clients routes
Route::middleware('auth:sanctum')->controller(ClientController::class)->prefix('clients')->group(function(){
    Route::get('/', 'index');
});

//invitations routes
Route::middleware('auth:sanctum')->controller(InvitationController::class)->prefix('invitations')->group(function(){
    Route::post('/', 'store');
});

//users per project routes
Route::middleware('auth:sanctum')->controller(UsersPerProjectController::class)->prefix('members')->group(function(){
    Route::get('/{uuid}', 'index');
});

//issue types routes
Route::middleware('auth:sanctum')->controller(IssueTypeController::class)->prefix('issue-types')->group(function(){
    Route::get('/', 'index');
});

//priorities routes
Route::middleware('auth:sanctum')->controller(PriorityController::class)->prefix('priorities')->group(function(){
    Route::get('/', 'index');
});

//Issues routes
Route::middleware('auth:sanctum')->controller(IssueController::class)->prefix('issues')->group(function(){
    Route::get('/{key}/{uuid}', 'index');
    Route::get('/{key}/{uuid}/{issue}', 'issue');
    Route::get('/{key}/{uuid}/{sprint}', 'perSprint');
    
    Route::put('/update/description/{key}/{uuid}/{issue}', 'updateDescription');
    Route::post('/{key}/{uuid}', 'store');
});

//issues per sprint routes
Route::middleware('auth:sanctum')->controller(IssuesPerSprintController::class)->prefix('issues-sprint')->group(function(){
    Route::get('/issue/{uuid}/{issue}', 'issue');
    Route::get('/issues/{project}/{sprint}', 'issues');
    
    Route::post('/store', 'store');
    Route::put('/update/{project}/{sprint}/{issue}', 'update');
    Route::delete('/delete/{project}/{sprint}/{issue}', 'delete');
});

//Attached files routes
Route::middleware('auth:sanctum')->controller(AttachedFileController::class)->prefix('attached-files')->group(function(){
    Route::get('/{uuid}/{issue}', 'index');
    Route::get('/{uuid}/{issue}/{file}', 'download');
    
    Route::post('/store/{uuid}/{key}', 'store');
    Route::delete('/delete/{uuid}/{issue}/{file}', 'delete');

});

//issue comments routes
Route::middleware('auth:sanctum')->controller(CommentController::class)->prefix('comments')->group(function(){
    Route::get('/{key}/{uuid}/{issue}', 'index');
    Route::post('/{key}/{uuid}/{issue}', 'store');

    Route::put('/update/{id}', 'update');
    Route::delete('delete/{id}', 'delete');
});

// Subtasks routes
Route::middleware('auth:sanctum')->controller(SubtaskController::class)->prefix('subtasks')->group(function (){
    Route::get('/{project}/{issue}', 'index');

    Route::post('/store/{project}/{issue}', 'store');
    Route::put('/update/{project}/{issue}', 'update');
    Route::delete('/delete/{project}/{issue}/{subtask}', 'delete');
});

//sprints routes
Route::middleware('auth:sanctum')->controller(SprintController::class)->prefix('sprints')->group(function (){
    Route::get('/{key}/{uuid}', 'index');
    Route::get('/sprint/{project}/{sprint}', 'sprint');

    Route::post('store/{key}/{uuid}', 'store');
});

//workflows routes
Route::middleware('auth:sanctum')->controller(WorkflowController::class)->prefix('workflows')->group(function(){
    Route::get('/{project}/{sprint}', 'index');
    Route::get('/issues/{project}/{sprint}/{workflow}', 'issues');
});