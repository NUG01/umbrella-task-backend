<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductCategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Models\ProductCategory;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(ProductCategoryController::class)->group(function () {
    Route::get('product-categories', 'index')->name('product.category.index');
    Route::post('add-category', 'store')->name('product.category.store');
});


Route::controller(ProductController::class)->group(function () {
    Route::get('products', 'index')->name('product.index');
    Route::post('add-product', 'store')->name('product.store');
    Route::delete('delete-product/{productId}', 'destroy')->name('product.destroy');
});
