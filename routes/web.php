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

Route::get('/', [WebController::class,"home"]);
Route::get('/about-us', [WebController::class,"aboutUs"]);

Route::get("/categories",[CategoryController::class,"all"]);
Route::get("/categories/new",[CategoryController::class,"form"]);
Route::post("/categories/save",[CategoryController::class,"save"]);

Route::get("/products",[ProductController::class,"all"]);
Route::get("/products/new",[ProductController::class,"form"]);
Route::post("/products/save",[ProductController::class,"save"]);
Route::get("/products/edit/{id}",[ProductController::class,"edit"]);
Route::post("/products/update/{id}",[ProductController::class,"update"]);
Route::get("/products/delete/{id}",[ProductController::class,"delete"]);
