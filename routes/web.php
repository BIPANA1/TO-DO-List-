<?php

use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[ListController::class,'welcome']);
  
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::get('/home',[ListController::class,'home']);

Route::post('/task',[ListController::class,'task']);
Route::get('/completed/{id}',[ListController::class,'done']);
Route::get('/destroy/{id}',[ListController::class,'destroy']);
Route::get('/filter',[ListController::class,'filterStatus'])->name('filter.status');
Route::get('/logout',[TaskController::class,'logout']);