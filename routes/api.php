<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectTypeController;
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
    Route::post('/', 'store');
});

Route::middleware('auth:sanctum')->controller(ClientController::class)->prefix('clients')->group(function(){
    Route::get('/', 'index');
});
