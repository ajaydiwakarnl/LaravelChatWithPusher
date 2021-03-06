<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\ChatsController::class,'index'])->name('index');
Route::post('fetchmessages/{receiver_id}', [App\Http\Controllers\ChatsController::class,'fetchMessages'])->name('fetchMessages');
Route::get('users', [App\Http\Controllers\ChatsController::class,'fetchUsers'])->name('fetchUsers');
Route::post('messages', [App\Http\Controllers\ChatsController::class,'sendMessage'])->name('sendMessage');
Route::post('searchUser/{keyword}', [App\Http\Controllers\ChatsController::class,'searchUsers'])->name('searchUsers');
