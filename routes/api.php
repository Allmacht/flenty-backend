<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueTypeController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\UsersPerProjectController;
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
    Route::post('/{key}/{uuid}', 'store');
});