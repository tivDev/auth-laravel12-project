<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Middleware\ApiAuthMiddleware;

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
// Example API route: http://127.0.0.1:8000/api/ping2
Route::get('/ping2', function () {
    return response()->json([
        'success' => 1, 
        'message' => 'Hello, world!, this is an API route'
    ]);
});

Route::get('/testing', [AuthController::class, 'testing']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware([ApiAuthMiddleware::class])->post('/logout', [AuthController::class, 'logout']);
Route::middleware([ApiAuthMiddleware::class])->get('/profile', [AuthController::class, 'profile']);
Route::get('/isGuestUser', [AuthController::class, 'isGuestUser']);