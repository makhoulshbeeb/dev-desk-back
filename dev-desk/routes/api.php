<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ScriptController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\DB;



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
Route::put('/updateUser/{id}', [AuthController::class, 'updateuserrole']);
Route::get('/allUser', [AuthController::class, 'getAllUser'])->middleware('admin');
Route::group(
[   'middleware'=>'user',
    'prefix' => 'chats',
    'controller' => ChatController::class,
],
function() {
    Route::get('/{username}', 'getChatByUsername');
    // Route::get('/getby', 'getChat');
    // Route::get('/create', 'createChat');
    // Route::get('/update', 'updateChat');
    // Route::get('/delete', 'deleteChat');
});
Route::apiResource('chats', ChatController::class)->middleware('admin');


Route::group(
[
        // 'middleware'=>'user',
        'prefix' => 'scripts',
        'controller' => ScriptController::class,
],
function() {
    Route::get('/id/{id}', 'getScriptbyID');
    Route::get('/{username}', 'getScriptbyUsername');
    Route::get('/search/{username}','getScriptbyLike');
    Route::post('/name','getScriptbyname');
});
Route::apiResource('scripts', ScriptController::class)->middleware('admin');


Route::group(
[   
    'middleware'=>'user',
    'prefix'=>'messages',
    'controller'=>MessageController::class,
],
function() {
    Route::get('/search/{username}', 'getmessagebyLike');
    Route::get('/getby/username/{username}', 'getMessage');
    Route::get('/{id}', 'getMessagesbychat_id');
});

Route::apiResource('messages', messageController::class);//->middleware('admin');