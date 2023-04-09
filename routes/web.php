<?php

use App\Http\Controllers\Admin\HandleAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ProviderAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\ProviderAuth\AuthenticatedSessionController as ProviderAuthAuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
                
});

require __DIR__.'/client_auth.php';



Route::get('/', function () {
    return view('welcome');
});


Route::group([ 'middleware' => ['auth:admin', 'verified'] , 'prefix' => 'admin' ], function()
{

        //permision
        Route::resource('roles', RoleController::class);
        Route::resource('admins', HandleAdminController::class);
      
    Route::get('dashboard',[AdminController::class ,'index'])->name('admin.dashboard');
    Route::get('categories',[AdminController::class ,'adminCategry'])->name('admin.category');
    //add category
    Route::get('add/category',[AdminController::class ,'addCategory'])->name('admin.addCategory');
    Route::post('store' , [AdminController::class , 'store'])->name('admistore.category');
    Route::post('save' , [AdminController::class , 'store'])->name('admin.save.category');

    //edite category
    Route::get('edite/category/{id}',[AdminController::class ,'edite'])->name('edit.category');
    Route::post('update/cateory/{id}',[AdminController::class ,'update'])->name('update.category');
    //delete category
    Route::get('delete/category/{id}',[AdminController::class ,'delete'])->name('delete.category');

    //sub_categories
    Route::get('sub_category', [AdminController::class , 'subCategories'])->name('admin.sub_categories');
    Route::get('add/sub_category',[AdminController::class ,'addSubCategory'])->name('admin.add.sub_categories');
    Route::post('store' , [ AdminController::class , 'storeSubCategroy' ])->name('store.subcategories');
    //edite category
    Route::get('edite/sub_category/{id}',[AdminController::class ,'edit_subCategories'])->name('edit.sub_category');
    Route::post('update/sub_cateory/{id}',[AdminController::class ,'update_subCategories'])->name('update.sub_category');
    //delete sub category
    Route::get('delete/sub_category/{id}',[AdminController::class ,'deleteSubCategories'])->name('delete.sub_category');


});
require __DIR__.'/adminauth.php';

Route::namespace('provider')->prefix('provider')->name('provider.')->group( function() {
    Route::namespace('Auth')->group(function(){
        
        Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

         Route::post('register', [RegisteredUserController::class, 'store'])->name('providerregister');
        //login
        Route::get('login',[ProviderAuthAuthenticatedSessionController::class ,'create'])->name('login');
        Route::post('login', [ProviderAuthAuthenticatedSessionController::class, 'store'])->name('providerlogin');
    });
});  
Route::group([ 'middleware' => ['auth:provider', 'verified'] , 'prefix' => 'provider' ], function()
{
    Route::get('dashboard',[ProviderController::class ,'index'])->name('provider.dashboard');
    Route::get('sub_categories',[ProviderController::class , 'allSubCategories'])->name('provider.categories');
});

