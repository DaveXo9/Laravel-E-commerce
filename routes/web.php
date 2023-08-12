<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\BrandController;



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

Route::get('/admin/categories', [CategoryController::class, 'index'])->middleware('auth:admin')->name('admin.categories.index');
Route::get('/admin/categories/create', [CategoryController::class, 'create'])->middleware('auth:admin')->name('admin.categories.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->middleware('auth:admin')->name('admin.categories.store');
Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware('auth:admin')->name('admin.categories.edit');
Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])->middleware('auth:admin')->name('admin.categories.update');
Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])->middleware('auth:admin')->name('admin.categories.destroy');
Route::get('/admin/categories/{category}', [CategoryController::class, 'show'])->middleware('auth:admin')->name('admin.categories.show');


Route::resource('/admin/brands', BrandController::class, ['as' => 'admin'])->middleware('auth:admin');