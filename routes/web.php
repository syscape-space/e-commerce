<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SubCategoryController;


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

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('products',ProductController::class);
Route::resource('vendors', VendorController::class);

#### start subCategories route ####

//resource
Route::resource('subCategories',SubCategoryController::class);
//softDelete route
Route::get('subCategories/soft/delete/{id}', [SubCategoryController::class,'softdelete'])->name('subCategories.soft.delete');
//hard route
Route::get('subCategories/hard/delete/{id}', [SubCategoryController::class,'hardDelete'])->name('subCategories.hard.delete');
//trash route
Route::get('subCategories.trash', [SubCategoryController::class, 'trash'])->name('subCategories.trash');
//Back from trash  route
Route::get('subCategories/back/from/trash/{id}', [SubCategoryController::class, 'backFromTrash'])->name('subCategories.back');

#### end subCategories route ####

