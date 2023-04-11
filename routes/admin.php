<?php

use App\Http\Controllers\Admin\HandleAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ProviderAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\FrontendController;


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
                Route::get('/',[AdminController::class ,'adminCategry'])->name('admin.category');
                //add category
                Route::get('add',[AdminController::class ,'addCategory'])->name('admin.addCategory');
                Route::post('store' , [AdminController::class , 'store'])->name('admistore.category');
                Route::post('save' , [AdminController::class , 'store'])->name('admin.save.category');
            
                //edite category
                Route::get('edite/{id}',[AdminController::class ,'edite'])->name('edit.category');
                Route::post('update/{id}',[AdminController::class ,'update'])->name('update.category');
                //delete category
                Route::get('delete/{id}',[AdminController::class ,'delete'])->name('delete.category');
            });

            //sub_categories
            Route::prefix('sub_categories')->group(function()
            {
                Route::get('/', [AdminController::class , 'subCategories'])->name('admin.sub_categories');
                Route::get('add/',[AdminController::class ,'addSubCategory'])->name('admin.add.sub_categories');
                Route::post('store' , [ AdminController::class , 'storeSubCategroy' ])->name('store.subcategories');
                //edite category
                Route::get('edite/{id}',[AdminController::class ,'edit_subCategories'])->name('edit.sub_category');
                Route::post('update/{id}',[AdminController::class ,'update_subCategories'])->name('update.sub_category');
                //delete sub category
                Route::get('delete/{id}',[AdminController::class ,'deleteSubCategories'])->name('delete.sub_category');
            });
           
        
           
       
      
   

});
require __DIR__.'/adminauth.php';

