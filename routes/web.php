<?php 

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SendEmailNotificationController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontProductListController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Search;
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

####### Frontend route #######
Route::get('/', [FrontProductListController::class , 'index'] )->name('frontend');
Route::get('/product/{id}', [FrontProductListController::class , 'show'] )->name('product.view');
Route::get('/category/{name}', [FrontProductListController::class , 'allProduct'] )->name('product.category');

####### end Frontend route #######



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/AdminDashbord', [HomeController::class, 'dashboard'])->name('dashboard');


//list all user
Route::get('/users', [UserController::class , 'list'] )->name('users.list');

########Categories########
Route::resource('categories', CategoriesController::class);

Route::controller(CategoriesController::class)->group(function () {
    Route::prefix('Categories')->group(function () {
        Route::get('/soft/delete/{id}', 'softdelete')->name('categories.soft.delete');
        Route::get('/hard/delete/{id}','hardDelete')->name('categories.hard.delete');
        Route::get('/back/from/trash/{id}', 'backFromTrash')->name('categories.back');
        Route::get('/trash/all', 'trash')->name('categories.trash');

    });
});
########End Categories########

#### start subCategories route ####
//resource
Route::resource('subCategories',SubCategoryController::class);

Route::controller(SubCategoryController::class)->group(function () {
    Route::prefix('subCategories')->group(function () {
        //softDelete route
        Route::get('/soft/delete/{id}','softdelete')->name('subCategories.soft.delete');
        //hard route
        Route::get('/hard/delete/{id}','hardDelete')->name('subCategories.hard.delete');
        //Back from trash  route
        Route::get('/back/from/trash/{id}', 'backFromTrash')->name('subCategories.back');
        //trash route
        Route::get('/trash/all','trash')->name('subCategories.trash');
    });    
    
});

#### end subCategories route ####

####### start Product route ###
//resource
Route::resource('products',ProductController::class);

Route::controller(ProductController::class)->group(function () {
    Route::prefix('products')->group(function () {
        //softDelete route
        Route::get('/soft/delete/{id}', 'softdelete')->name('products.soft.delete');
        //hard route
        Route::get('/hard/delete/{id}', 'hardDelete')->name('products.hard.delete');
        //Back from trash  route
        Route::get('/back/from/trash/{id}',  'backFromTrash')->name('products.back');
        //trash route
        Route::get('/trash/all','trash')->name('products.trash');
    });
    
    
});

#### end products route ####

####### start vendors route ####
Route::resource('vendors', VendorController::class);
####### start vendors route ######


##################################### Send email to all users Route #############################
Route::get('/send.email',[SendEmailNotificationController::class,'sendEmailToUsers'])->name('send.email');
Route::post('/send.email.to.all.users',[SendEmailNotificationController::class,'sendEmailToAllUsers'])->name('send.email.to.all.users');
##################################33# start Product route ################################



//Notification Route
Route::get('/notification',[NotificationController::class,'productNotify']);

################################# Product Notification Route ##############################
    Route::get('/notification',[NotificationController::class,'productNotify'])->name('notifications');

    Route::get('/seennotification',[NotificationController::class,'seenNotification'])->name('notifications.read');
    Route::get('/notification.mark.as.read/{id}', [NotificationController::class,'toMarkAsRead'])->name('notifications.markasread');
    Route::get('/notification.mark.as.un.read/{id}', [NotificationController::class,'toMarkAsUnRead'])->name('notifications.markasunread');
    Route::get('/delete.all.notification',[NotificationController::class,'deleteAll'])->name('deleteAllNotification');
    Route::get('/delete.notification/{id}',[NotificationController::class,'delete'])->name('deleteNotification');
    Route::get('/mark.all.as.read.notification',[NotificationController::class,'toMarkAllAsRead'])->name('markAllAsRead.notification');
    Route::get('/mark.all.as.un.read.notification',[NotificationController::class,'toMarkAllAsUnRead'])->name('markAllAsUnRead.notification');
################################# end Product Notification Route ##############################


################################## Cart Route #################################
    Route::get('cart', [CartController::class, 'cartList'])->name('cart.list')->middleware('auth');
    Route::get('cart/{id}', [CartController::class, 'addToCart'])->name('cart.store')->middleware('auth');
    Route::post('update-cart/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
    Route::get('remove/{id}', [CartController::class, 'destroy'])->name('cart.remove')->middleware('auth');
    Route::get('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
    Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');
################################## end Cart Route #################################



############  Google Authentication Routes ###############################
Route::get('auth/google', [SocialController::class, 'googleRedirect'])->name('google.login');
Route::get('auth/google/Callback', [SocialController::class, 'Callback']);









  



