<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SendEmailNotificationController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontProductListController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SocialController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ShareSocialController; 



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

//Route::get('/', function () {    return view('welcome'); });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');


####### Frontend route #######

Route::get('/', [FrontProductListController::class , 'index'] )->name('frontend');
Route::get('/product/{id}', [FrontProductListController::class , 'show'] )->name('product.view');
Route::get('/users', [UserController::class , 'list'] )->name('users.list');





Route::get('/Dashboard', function () {
    return view('admin.layouts.main');
});

####### end Frontend route #######



//Notification Route
Route::get('/notification',[NotificationController::class,'productNotify']);

//################################# Product Notification Route ##############################
Route::get('/notification',[NotificationController::class,'productNotify'])->name('notifications');

Route::get('/seennotification',[NotificationController::class,'seenNotification'])->name('notifications.read');
Route::get('/notification.mark.as.read/{id}', [NotificationController::class,'toMarkAsRead'])->name('notifications.markasread');
Route::get('/notification.mark.as.un.read/{id}', [NotificationController::class,'toMarkAsUnRead'])->name('notifications.markasunread');
Route::get('/delete.all.notification',[NotificationController::class,'deleteAll'])->name('deleteAllNotification');
Route::get('/delete.notification/{id}',[NotificationController::class,'delete'])->name('deleteNotification');
Route::get('/mark.all.as.read.notification',[NotificationController::class,'toMarkAllAsRead'])->name('markAllAsRead.notification');
Route::get('/mark.all.as.un.read.notification',[NotificationController::class,'toMarkAllAsUnRead'])->name('markAllAsUnRead.notification');


# ---------------------------- Categories routes -----------------------------------
Route::resource('categories', CategoriesController::class);

Route::controller(CategoriesController::class)->group(function () {
    Route::prefix('Categories')->group(function () {
        Route::get('/soft/delete/{id}', 'softdelete')->name('categories.soft.delete');
        Route::get('/hard/delete/{id}','hardDelete')->name('categories.hard.delete');
        Route::get('/back/from/trash/{id}', 'backFromTrash')->name('categories.back');
    });
    Route::get('Categories.trash', 'trash')->name('categories.trash');
});


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


##################################### Send email to all users Route #############################
Route::get('/send.email',[SendEmailNotificationController::class,'sendEmailToUsers'])->name('send.email');
Route::post('/send.email.to.all.users',[SendEmailNotificationController::class,'sendEmailToAllUsers'])->name('send.email.to.all.users');
##################################33# start Product route ################################


################################# start Product route ################################
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

################################# start vendors route ################################

Route::resource('vendors', VendorController::class);

################################# start vendors route ################################



############  Google Authentication Routes ###############################
Route::get('auth/google', [SocialController::class, 'googleRedirect'])->name('google.login');
Route::get('auth/google/callback', [SocialController::class, 'googleCallback']);


  




