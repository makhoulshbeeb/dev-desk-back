<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ScriptController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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