<?php

use App\Http\Controllers\LoginController;
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

Route::get('/university/info', [LoginController::class, 'getUniversity']);
Route::post('/user/create', [LoginController::class, 'register']);
Route::post('/user/login', [LoginController::class, 'login']);
Route::middleware(['auth'])->group(function () {
});
Route::get('/user/infor', [LoginController::class, 'getUser']);
