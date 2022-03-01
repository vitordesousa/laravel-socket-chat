<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\ConversationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group(['prefix' => 'admin'], function(){
    Route::get('/conversations', [ConversationController::class, 'admin_index']);
    Route::get('/messages/{conversation:id}/{customer:id}', [MessageController::class, 'index']);
    Route::post('/messages', [MessageController::class, 'store']);
});

Route::group(['prefix' => 'panel'], function(){
    Route::get('/messages', [MessageController::class, 'user_index']);
    Route::post('/messages', [MessageController::class, 'user_store']);
});