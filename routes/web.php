<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Auth;

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

//Notification Route
Route::get('/home/notification',[NotificationController::class,'productNotify']);
Route::get('/notification/{id}', [NotificationController::class,'toMarkAsRead'])->name('notifications.read');

##################################33# start Product route ################################

//resource
Route::resource('products',ProductController::class);
//softDelete route
Route::get('products/soft/delete/{id}', [ProductController::class,'softdelete'])->name('products.soft.delete');
//hard route
Route::get('products/hard/delete/{id}', [ProductController::class,'hardDelete'])->name('products.hard.delete');
//trash route
Route::get('products.trash', [ProductController::class, 'trash'])->name('products.trash');
//Back from trash  route
Route::get('products/back/from/trash/{id}', [ProductController::class, 'backFromTrash'])->name('products.back');

#### end products route ####

Route::resource('vendors', VendorController::class);

#########################3 start subCategories route #########################33#

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

# --------- Categories routes ----------------------
Route::resource('Categories', CategoriesController::class);

Route::controller(CategoriesController::class)->group(function () {
    Route::prefix('Categories')->group(function () {
        Route::get('.soft/delete/{id}', 'softdelete')->name('Categories.soft.delete');
        Route::get('/hard/delete/{id}','hardDelete')->name('categories.hard.delete');
        Route::get('/back/from/trash/{id}', 'backFromTrash')->name('categories.back');
    });
    Route::get('Categories.trash', 'trash')->name('categories.trash');
});
