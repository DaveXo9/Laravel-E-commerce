<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;


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

Route::get('/admin', [LoginController::class, 'index'])->middleware('auth:admin')->name('admin.dashboard');
Route::get('/admin/login', [LoginController::class, 'login'])->middleware('guest:admin')->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'authenticate'])->middleware('guest:admin')-> name('admin.login.post');
Route::get('/admin/logout', [LoginController::class, 'logout'])->middleware('auth:admin')->name('admin.logout');

Route::resource('/admin/categories', CategoryController::class, ['as' => 'admin'])->middleware('auth:admin');