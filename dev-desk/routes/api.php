<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});

Route::group(
[
    'prefix'=>'messages',
    'controller'=>MessageController::class,
],
function() {
    Route::get('/getall', 'getAllMessages');
    Route::post('/getby', 'getMessage');
    Route::post('/create', 'createMessage');
    Route::post('/delete', 'deleteMessage');
    Route::post('/update', 'updateMessage');
});


Route::group(
[
    'prefix' => 'chats',
    'controller' => ChatController::class,
],
function() {
    Route::get('/getall', 'getAllChats');
    Route::post('/getby', 'getChat');
    Route::post('/create', 'createChat');
    Route::post('/update', 'updateChat');
    Route::post('/delete', 'deleteChat');
});


Route::group(
[
        'prefix' => 'scripts',
        'controller' => ScriptController::class,
],
function() {
    Route::get('/getall', 'getAllScripts');
    Route::post('/getby', 'getScript');
    Route::post('/create', 'createScript');
    Route::post('/update', 'updateScript');
    Route::post('/delete', 'deleteScript');
});