<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
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

    //authunticate
    Route::post('/login',[UserController::class,'login']);
    Route::post('/register',[UserController::class,'register']);

    //middleware api
    Route::group(['middleware' => 'auth:api'],function(){
        Route::post('/logout',[UserController::class,'logout']);
        Route::delete('/delete',[UserController::class,'delete']);
    });

});

Route::group(['prefix' => '/category'],function(){

    //middleware api
    Route::group(['middleware' => 'auth:api'],function(){
        Route::post('/upsert',[CategoryController::class,'upsert']);
        Route::delete('/delete/{category}',[CategoryController::class,'delete']);
    });

});

Route::group(['prefix' => '/brand'],function () {

    Route::group(['middleware' => 'auth:api'],function(){
        Route::post('/upsert',[BrandController::class,'upsert']);
        Route::delete('/delete/{brand}',[BrandController::class,'delete']);
    });

});
