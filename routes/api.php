<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return dd(Auth::user()->logout());
});

Route::group(['prefix' => '/user'],function(){
    Route::post('/login',[UserController::class,'login']);
    Route::post('/register',[UserController::class,'register']);
    Route::post('/logout',[UserController::class,'logout'])->middleware('auth:api');
    Route::post('/delete/{user}',[UserController::class,'delete']);
});