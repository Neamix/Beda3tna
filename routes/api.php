<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return dd(Auth::user()->logout());
// });

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

Route::group(['prefix' => '/product'],function () {

    Route::group(['middleware' => 'auth:api'],function(){
        Route::post('/upsert',[ProductController::class,'upsert']);
        Route::delete('/delete/{product}',[ProductController::class,'delete']);
    });

});

Route::group(['prefix' => '/order'],function () {

    Route::group(['middleware' => 'auth:api'],function(){
        Route::post('/upsert',[OrderController::class,'upsert']);
        Route::delete('/delete/{order}',[OrderController::class,'delete']);
    });

});

Route::group(['prefix' => '/sale'],function () {

    Route::group(['middleware' => 'auth:api'],function(){
        Route::post('/upsert',[SaleController::class,'upsert']);
        Route::delete('/delete/{sale}',[SaleController::class,'delete']);
    });

});

