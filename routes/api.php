<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function (){
    Route::get('admin', [UserController::class, 'admin']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/position_list', [PositionController::class, 'list']);
    Route::get('/employee_list', [EmployeeController::class, 'list']);

    Route::post('/upload', [ImageUploadController::class, 'upload']);

    Route::apiResource('/positions', PositionController::class);
    Route::apiResource('/employees', EmployeeController::class);
    Route::apiResource('/admins', UserController::class)->only('index', 'store');
});
