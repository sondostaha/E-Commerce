<?php

use App\Http\Controllers\Admin\HandleAdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\RoleController;

use App\Http\Controllers\Api\admins\adminsController;
use App\Http\Controllers\Api\Auth\AdminAuthController;
use App\Http\Controllers\FrontendController;


/*
|--------------------------------------------------------------------------
| Admin Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->group( function() 
{
   
    //login
    Route::post('login',[AdminAuthController::class ,'login']);

    Route::prefix('Home')->group(function()
    {
        Route::get('/',[FrontendController::class ,'index'])->name('frontend');
        //categories
        Route::get('categories',[FrontendController::class ,'category'])->name('allcategories');
        //show categories
        Route::get('show/categories/{id}',[FrontendController::class ,'showcategory' ])->name('show.categories');
        
        //subcategories
        Route::get('sub_categories',[FrontendController::class ,'sub_categories'])->name('sub_categories');
        //show sub_categories
        Route::get('show/sub_categories/{id}',[FrontendController::class ,'showSub_category' ])->name('show.sub_categories');
        
        Route::get('view/product/{id}',[FrontendController::class ,'show_product']);
        
        Route::get('/dashboard',[FrontendController::class ,'index'])->middleware(['auth', 'verified'])->name('dashboard');
        
    });

    Route::middleware('auth:admin_api')->group(function () 
    {
            //permision
            Route::resource('roles', RoleController::class);
            Route::resource('admins', HandleAdminController::class);

                //categories
                Route::prefix('categories')->group(function()
                {
                    Route::get('/',[adminsController::class ,'adminCategry']);
                    //add category
                    Route::post('add' , [adminsController::class , 'store']);
                
                    //edite category
                    Route::post('update/{id}',[adminsController::class ,'update']);
                    //delete category
                    Route::get('delete/{id}',[adminsController::class ,'delete']);
                });

                //sub_categories
                Route::prefix('sub_categories')->group(function()
                {
                    Route::get('/', [adminsController::class , 'subCategories']);
                    Route::post('add' , [ adminsController::class , 'storeSubCategroy' ]);
                    //edite category
                    Route::post('update/{id}',[adminsController::class ,'update_subCategories']);
                    //delete sub category
                    Route::get('delete/{id}',[adminsController::class ,'deleteSubCategories']);
                });

                //order 
                Route::get('orders',[adminsController::class , 'orders']);
                Route::get('order/{id}', [adminsController::class ,'showOrder']);
                //view order

    });

});  



