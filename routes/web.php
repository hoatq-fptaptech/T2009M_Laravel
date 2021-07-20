<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
//Route::get("/",)
Route::get("/add-to-cart/{id}",[WebController::class,"addToCart"]);
Route::get("/cart",[WebController::class,"cart"]);
Route::get("/checkout",[WebController::class,"checkout"]);
Route::post("/create-order",[WebController::class,"createOrder"]);
Route::get("/update-qty/{id}",[WebController::class,"updateQty"]);
