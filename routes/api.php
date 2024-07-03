<?php

use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);

// Staff Related Route

Route::post('/register', [UserController::class, 'register']);
Route::get('/staff', [UserController::class, 'staff']);
Route::get('/staff/{userId}', [UserController::class, 'getStaffById']);
Route::put('/staff/{userId}/activate', [UserController::class, 'activateStaff']);
Route::put('/staff/{userId}/deactivate', [UserController::class, 'deactivateStaff']);
Route::put('/staff/{userId}/update', [UserController::class, 'updateStaff']);