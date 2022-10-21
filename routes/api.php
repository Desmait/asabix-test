<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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

Route::group(['prefix'=>'post', 'middleware' => ['language']], function() {
    Route::get('', [PostController::class, 'index']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::post('', [PostController::class, 'store']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'delete']);
});

Route::group(['prefix'=>'tag'], function() {
    Route::get('', [TagController::class, 'index']);
    Route::get('/{id}', [TagController::class, 'show']);
    Route::post('', [TagController::class, 'store']);
    Route::put('/{id}', [TagController::class, 'update']);
    Route::delete('/{id}', [TagController::class, 'delete']);
});

