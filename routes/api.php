<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ChatController;
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
Route::middleware(['auth:sanctum', 'auth:web'])->group(function () {
    Route::get('/user/getUserInfor', [LoginController::class, 'inforUser']);
    Route::get('/user/logout', [LoginController::class, 'logout']);
    Route::put('/user/editProfile/{id}', [LoginController::class, 'updateUser']);
    
    Route::post('/article/create', [ArticleController::class,'store']);
    Route::get('/article/index', [ArticleController::class,'index']);
    Route::delete('/article/{id}', [ArticleController::class,'delete']);
    Route::get('/article/{id}/edit', [ArticleController::class,'edit']);
    Route::put('/article/{id}', [ArticleController::class,'update']);
    
    Route::put('/chat/create', [ChatController::class, 'create']);
});
Route::get('/user/listchat/{id}', [LoginController::class, 'getAllUsers']);
