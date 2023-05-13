<?php

use App\Http\Controllers\Admin\HandleAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ProviderAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\frontend\FrontendController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[FrontendController::class ,'index'])->name('frontend');
//categories
Route::get('categories',[FrontendController::class ,'category'])->name('allcategories');
//show categories
Route::get('show/categories/{id}',[FrontendController::class ,'showcategory' ])->name('show.categories');

//subcategories
Route::get('sub_categories',[FrontendController::class ,'sub_categories'])->name('sub_categories');

//show sub_categories
Route::get('show/sub_categories/{id}',[FrontendController::class ,'showSub_category' ])->name('show.sub_categories');

Route::get('view/product/{id}',[FrontendController::class ,'show_product'])->name('show.products');





Route::group([ 'middleware' => ['auth:admin', 'verified'] , 'prefix' => 'admin' ], function()
{

        //permision
        Route::resource('roles', RoleController::class);
        Route::resource('admins', HandleAdminController::class);

            Route::get('dashboard',[AdminController::class ,'index'])->name('admin.dashboard');

            //categories
            Route::prefix('categories')->group(function()
            {
                Route::get('/',[CategoryController::class ,'index'])->name('admin.category');
                //add category
                Route::get('add',[CategoryController::class ,'add'])->name('admin.addCategory');
                Route::post('store' , [CategoryController::class , 'store'])->name('admistore.category');
                Route::post('save' , [CategoryController::class , 'store'])->name('admin.save.category');
            
                //edite category
                Route::get('edite/{id}',[CategoryController::class ,'edite'])->name('edit.category');
                Route::post('update/{id}',[CategoryController::class ,'update'])->name('update.category');
                //delete category
                Route::get('delete/{id}',[CategoryController::class ,'delete'])->name('delete.category');
            });

            //sub_categories
            Route::prefix('sub_categories')->group(function()
            {
                Route::get('/', [SubCategoryController::class , 'index'])->name('admin.sub_categories');
                Route::get('add/',[SubCategoryController::class ,'add'])->name('admin.add.sub_categories');
                Route::post('store' , [ SubCategoryController::class , 'store' ])->name('store.subcategories');
                //edite category
                Route::get('edite/{id}',[SubCategoryController::class ,'edite'])->name('edit.sub_category');
                Route::post('update/{id}',[SubCategoryController::class ,'update'])->name('update.sub_category');
                //delete sub category
                Route::get('delete/{id}',[SubCategoryController::class ,'delete'])->name('delete.sub_category');
            });

            //order 
            Route::get('orders',[OrdersController::class , 'index'])->name('aallorders');
            Route::get('show/order/{id}', [OrdersController::class ,'show'])->name('ashow.order');
            //view order
           
        
           
       
      
   

});
require __DIR__.'/adminauth.php';

