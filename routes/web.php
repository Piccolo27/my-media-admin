<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TrendPostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    //admin
    Route::get('dashboard',[ProfileController::class,'index'])->name('dashboard');
    Route::post('admin/update',[ProfileController::class,'update'])->name('admin#update');
    Route::get('admin/changePassword',[ProfileController::class,'changePasswordPage'])->name('admin#changePasswordPage');
    Route::post('admin/changePassword',[ProfileController::class,'changePassword'])->name('admin#changePassword');

    //admin list
    Route::get('admin/list',[ListController::class,'index'])->name('admin#list');
    Route::get('admin/list/delete/{id}',[ListController::class,'deleteAccount'])->name('admin#accountDelete');
    Route::post('admin/list',[ListController::class,'adminListSearch'])->name('adminList#search');

    //category
    Route::get('category',[CategoryController::class,'index'])->name('admin#category');
    Route::post('category/create',[CategoryController::class,'create'])->name('category#create');
    Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
    Route::post('category/search',[CategoryController::class,'search'])->name('category#search');
    Route::get('category/edit/{id}',[CategoryController::class,'editPage'])->name('category#editPage');
    Route::post('category/update/{id}',[CategoryController::class,'update'])->name('category#update');

    //post
    Route::get('post',[PostController::class,'index'])->name('admin#post');
    Route::post('post/create',[PostController::class,'create'])->name('post#create');
    Route::get('post/delete/{id}',[PostController::class,'delete'])->name('post#delete');
    Route::get('post/update/page/{id}',[PostController::class,'updatePage'])->name('post#updatePage');
    Route::post('post/update/{id}',[PostController::class,'update'])->name('post#update');

    //trend post
    Route::get('trendPost',[TrendPostController::class,'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}',[TrendPostController::class,'details'])->name('admin#trendPostDetails');


});
