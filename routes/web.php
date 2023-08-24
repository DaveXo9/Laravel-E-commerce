<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\OrderController;

use App\Http\Controllers\Site\AccountController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Site\CheckoutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Site\CategoriesController;
use App\Http\Controllers\Site\UserProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductAttributeTypeController;



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
// Route::get('/admin/categories/{category}', [CategoriesController::class, 'show'])->name('admin.categories.show');

Route::get('/categories/{slug}',  [CategoriesController::class,'show'])->name('category.show');

Route::resource('/admin/brands', BrandController::class, ['as' => 'admin'])->middleware('auth:admin');

Route::resource('/admin/products', ProductController::class, ['as' => 'admin'])->middleware('auth:admin');

Route::get('/product/{slug}', [UserProductController::class, 'show'])->name('product.show');
Route::post('/product/add/cart', [UserProductController::class, 'addToCart'])->name('product.add.cart');



Route::post('/images/upload/{product}', [ProductImageController::class, 'store'])->middleware('auth:admin')->name('admin.products.images.upload');
Route::delete('/images/{image}', [ProductImageController::class, 'destroy'])->middleware('auth:admin')->name('admin.products.images.destroy');


Route::resource('/admin/attributes', ProductAttributeTypeController::class, ['as' => 'admin'])->middleware('auth:admin');

Route::post('/admin/product_attributes', [ProductAttributeController::class, 'store'])->middleware('auth:admin')->name('admin.attributes.values.store');

Route::put('/admin/product_attributes/{product_attribute}', [ProductAttributeController::class, 'update'])->middleware('auth:admin')->name('admin.attributes.values.update');

Route::delete('/admin/product_attributes/{product_attribute}', [ProductAttributeController::class, 'destroy'])->middleware('auth:admin')->name('admin.attributes.values.destroy');

Route::put('/admin/product_attributes/add/{product}', [ProductAttributeController::class, 'addAttributeToProduct'])->middleware('auth:admin')->name('admin.attributes.values.add');
Route::put('/admin/product_attributes/remove/{product}', [ProductAttributeController::class, 'removeAttributeFromProduct'])->middleware('auth:admin')->name('admin.attributes.values.remove');



Route::view('/', 'site.pages.homepage');

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'create'])->name('register');
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/users/authenticate', [UserController::class, 'authenticate']);
    Route::post('/users', [UserController::class, 'store']);
});



Route::post('/logout', [UserController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/cart', [CartController::class, 'getCart'])->name('checkout.cart');
Route::get('/cart/item/{id}/remove', [CartController::class, 'removeItem'])->name('checkout.cart.remove');
Route::get('/cart/clear', [CartController::class, 'clearCart'])->name('checkout.cart.clear');

Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index')->middleware('auth');
Route::post('/checkout/order', [CheckoutController::class, 'store'])->name('checkout.place.order')->middleware('auth');
Route::get('/checkout/payment/complete', [CheckoutController::class, 'complete'])->name('checkout.payment.complete')->middleware('auth');


Route::get('/account/orders', [AccountController::class, 'getOrders'])->name('account.orders')->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index')->middleware('auth:admin');
   Route::get('/orders/{order}/show', [OrderController::class, 'show'])->name('admin.orders.show')->middleware('auth:admin');



