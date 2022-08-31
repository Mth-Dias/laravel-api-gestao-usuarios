<?php

use App\Http\Controllers\AuthenticationController;
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

Route::middleware('guest')->post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/session_details', [AuthenticationController::class, 'sessionDetails']);
    Route::delete('/logout', [AuthenticationController::class, 'logout']);
    Route::delete('/end_all_sessions', [AuthenticationController::class, 'endAllSessions']);

    Route::apiResources([
        'users' => UserController::class,
    ]);
});
