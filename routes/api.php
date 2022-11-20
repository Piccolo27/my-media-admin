<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ActionLogsController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login',[AuthController::class,'login']);
Route::post('user/register',[AuthController::class,'register']);

Route::get('category',[AuthController::class,'categoryList'])->middleware('auth:sanctum');

//post
Route::get('allPostList',[PostController::class,'getAllPost']);
Route::post('posts/search',[PostController::class,'postSearch']);
Route::post('posts/details',[PostController::class,'postDetails']);

//category
Route::get('allCategory',[CategoryController::class,'getAllCategory']);
Route::post('categories/search',[CategoryController::class,'categorySearch']);

//action logs
route::post('posts/action-logs',[ActionLogsController::class,'setActionLogs']);
