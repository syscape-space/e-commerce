<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
<<<<<<< HEAD
use App\Http\Controllers\VendorController;

=======
use Illuminate\Support\Facades\Auth;
>>>>>>> 57d9538bca18c5f0b043b7f23234a99abc220f46

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

<<<<<<< HEAD
  

Route::resource('vendors', VendorController::class);
=======
/* -----------   categoried routes      -------------------*/
Route::controller(CategoryController::class)->group(function () {
    Route::prefix('categorie')->group(function () {
        Route::get('/index', 'index')->name('index_category');
        Route::get('/create', 'create')->name('create_category');
        Route::get('/store', 'store')->name('store_category');
        Route::get('/show', 'show')->name('show_category');
        Route::get('/edit', 'edit')->name('edit_category');
        Route::get('/update/id', 'update')->name('update_category');
        Route::get('/destroy/id', 'destroy')->name('edit_category');
   });
});

>>>>>>> 57d9538bca18c5f0b043b7f23234a99abc220f46
