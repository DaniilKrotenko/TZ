<?php

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



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::post('/edit-product', [App\Http\Controllers\HomeController::class, 'editProduct'])->name('editProduct');
Route::post('/delete-product', [App\Http\Controllers\HomeController::class, 'deleteProduct'])->name('deleteProduct');
Route::post('/add-product', [App\Http\Controllers\HomeController::class, 'addProduct'])->name('addProduct');


Route::post('/add-category', [App\Http\Controllers\HomeController::class, 'addCategory'])->name('addCategory');
Route::post('/edit-category', [App\Http\Controllers\HomeController::class, 'editCategory'])->name('editCategory');
Route::post('/delete-category', [App\Http\Controllers\HomeController::class, 'deleteCategory'])->name('deleteCategory');


Route::post('/delete-product-view', [App\Http\Controllers\HomeController::class, 'deleteProductView'])->name('deleteProductView');
Route::post('/edit-product-view', [App\Http\Controllers\HomeController::class, 'editProductView'])->name('editProductView');

Route::get('/product-page', [App\Http\Controllers\HomeController::class, 'productPage'])->name('productPage');

