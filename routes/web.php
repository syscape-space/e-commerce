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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\Search;
use App\Http\Controllers\SocialController;
 use Laravel\Socialite\Facades\Socialite;
 use App\Http\Controllers\ShareSocialController;
 use App\Http\Controllers\RoleController;
 use App\Http\Controllers\PermissionController;
use Darryldecode\Cart\CartCondition;

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


##########    list all user  #######################

Route::resource('users', UserController::class);
Route::controller(UserController::class)->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/users', 'index')->name('user.index');
        Route::get('/users/create', 'create')->name('user.create');
        Route::get('/users/show/{id}','show')->name('user.show');
        Route::get('/users/edit/{id}', 'edit')->name('user.edit');
        Route::get('/trash/all','destroy')->name('user.trash');
        Route::get('/back/from/trash/{id}', 'backFromTrash')->name('user.back');

    });
});



########Categories######   

Route::resource('categories', CategoriesController::class);

Route::controller(CategoriesController::class)->group(function () {
    Route::prefix('Categories')->group(function () {
        Route::get('/soft/delete/{id}', 'softdelete')->name('categories.soft.delete');
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
        //accept product route
        Route::get('/list/ToAccept', 'listProductsToAccept')->name('products.accept.list');
        Route::get('/accept/{id}', 'AcceptProduct')->name('product.accept');
        Route::get('/decline/{id}','declineProduct')->name('product.decline');
    });     

    });

####### start vendors route ####
Route::group(['middleware' => ['role:administrator|vendor']], function () {
    Route::resource('vendors', VendorController::class);
    Route::get('categorie/create', [CategoriesController::class ,'create']);
});
####### start vendors route ######


##################################### Send email to all users Route #############################
Route::get('/send.email',[SendEmailNotificationController::class,'sendEmailToUsers'])->name('send.email');
Route::post('/send.email.to.all.users',[SendEmailNotificationController::class,'sendEmailToAllUsers'])->name('send.email.to.all.users');

################################# Product Notification Route ##############################
Route::controller(NotificationController::class)->group(function(){
    Route::prefix('admin')->middleware('auth','Admin')->group(function(){
        Route::get('/notification.Notification','adminNotification')->name('admin.notifications'); 
        Route::get('/notification.markasread/{id}', 'adminToMarkAsRead')->name('notifications.admin.markasread');
        Route::get('/notification.markasunread/{id}', 'adminToMarkAsUnRead')->name('notifications.admin.markasunread');
        Route::get('/delete.all.notification','adminDeleteAll')->name('adminDeleteAllNotification');
        Route::get('/delete.notification/{id}','deleteAdmin')->name('admin.deleteNotification');
        Route::get('/markAllAsRead.notification','adminToMarkAllAsRead')->name('admin.markAllAsRead.notification');
        Route::get('/markAllAsUnRead.notification','adminToMarkAllAsUnRead')->name('admin.markAllAsUnRead.notification');
    });
    Route::get('/notification','productNotify')->name('notifications')->middleware('auth');
    Route::get('/seen/notification','seenNotification')->name('notifications.read')->middleware('auth');
    Route::get('/notification.markasread/{id}', 'toMarkAsRead')->name('notifications.markasread')->middleware('auth');
    Route::get('/notification.markasunread/{id}', 'toMarkAsUnRead')->name('notifications.markasunread')->middleware('auth');
    Route::get('/delete.all.notification','deleteAll')->name('deleteAllNotification')->middleware('auth');
    Route::get('/delete.notification/{id}','delete')->name('deleteNotification')->middleware('auth');
    Route::get('/markallAsRead.notification','toMarkAllAsRead')->name('markAllAsRead.notification')->middleware('auth');
    Route::get('/markAllAsUnRead.notification','toMarkAllAsUnRead')->name('markAllAsUnRead.notification')->middleware('auth');
});
Route::get('/seen/notification/admin',[NotificationController::class,'seenAdminNotification'])->name('notifications.read.admin')->middleware('auth','Admin');
################################# end Product Notification Route ##############################


################################## Cart Route #################################
Route::controller(CartController::class)->group(function(){
    Route::get('cart', 'cartList')->name('cart.list')->middleware('auth');
    Route::get('cart/{id}', 'addToCart')->name('cart.store')->middleware('auth');
    Route::post('update-cart/{id}', 'update')->name('cart.update')->middleware('auth');
    Route::get('remove/{id}', 'destroy')->name('cart.remove')->middleware('auth');
    Route::get('clear', 'clearAllCart')->name('cart.clear')->middleware('auth');
    Route::get('checkout', 'checkout')->name('cart.checkout')->middleware('auth');
});
################################## end Cart Route #################################

########################################### Order route ############################
Route::controller(OrderController::class)->group(function(){
    Route::get('order/show/{id}','userOrders')->name('user.orders')->middleware('auth');
    Route::get('order/delete/{id}','deleteOrder')->name('order.delete')->middleware('auth');
    Route::get('order/delivered/{id}','markOrderAsDelivered')->name('order.delivered')->middleware('auth');
    Route::post('order/store','store')->name('order')->middleware('auth');
    Route::get('user/orders','listOrdersToAccept')->name('orders.accept.list')->middleware('auth','Admin');
    Route::get('order/accept/{id}', 'acceptOrder')->name('order.accept')->middleware('auth','Admin');
    Route::get('order/decline/{id}','declineOrder')->name('order.decline')->middleware('auth','Admin');
});
    
######################### end order route ##########################


############  Google Authentication Routes ###############################
Route::get('auth/google', [SocialController::class, 'googleRedirect'])->name('google.login');
Route::get('auth/google/Callback', [SocialController::class, 'Callback']);






################################## Cart Route #################################


Route::get('cart', [CartController::class, 'cartList'])->name('cart.list')->middleware('auth');
Route::get('cart/{id}', [CartController::class, 'addToCart'])->name('cart.store')->middleware('auth');
Route::post('update-cart/{id}', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::get('remove/{id}', [CartController::class, 'destroy'])->name('cart.remove')->middleware('auth');
Route::get('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::get('checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth');

############## laratrust/roles/permission route ##############################

 Route::group(['middleware' => ['role:superadministrator|administrator']], function () {
     
     Route::resource('permission', 'PermissionController');
     Route::resource('roles', 'RoleController');
    });
 ############# end  route ##############################