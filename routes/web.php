<?php

use App\Http\Controllers\categorie;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
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

Route::resource('products',ProductController::class);

/* -----------   categoried routes      -------------------*/
Route::controller(categorie::class)->group(function () {
    Route::prefix('categorie')->group(function () {
    Route::get('/Create', 'Create')->name('create_categorie');
    Route::get('/Destroy/id', 'Destroy')->name('Destroy_categorie');
    Route::get('/Update/id', 'Update')->name('Update_categorie');
    Route::get('/Read_all', 'Read_all')->name('Read_all_categorie');
   });
});

