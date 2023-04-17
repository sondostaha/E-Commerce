<?php

use App\Http\Controllers\Api\Auth\ProviderAuthController;
use App\Http\Controllers\Api\provider\providerController as ProviderProviderController;
use App\Http\Controllers\Api\providers\ProvidersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\ProviderAuth\RegisteredUserController;
use App\Http\Controllers\ProviderAuth\AuthenticatedSessionController;
use App\Http\Controllers\ProviderAuth\AuthenticatedSessionController as ProviderAuthAuthenticatedSessionController;


/*
|--------------------------------------------------------------------------
| provider api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix('provider')->group( function() 
{
    
    Route::post('register', [ProviderAuthController::class, 'register']);
    
    //login
    Route::post('login',[ProviderAuthController::class ,'login']);

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
        
        Route::get('view/product/{id}',[FrontendController::class ,'show_product'])->name('show.products');
        
        Route::get('/dashboard',[FrontendController::class ,'index'])->middleware(['auth', 'verified'])->name('dashboard');
        
    });

    Route::middleware('auth:provider_api')->group(function () 
    {
        Route::get('dashboard',[ProvidersController::class ,'index']);
    
        
        Route::get('sub_categories',[ProvidersController::class , 'allSubCategories']);

        Route::prefix('products')->group(function()
        {
            Route::get('show/{id}',[ProvidersController::class ,'show_details']);
            //craete products

            Route::post('add',[ProvidersController::class , 'store_products']);

            //edite product
            Route::post('update/{id}',[ProvidersController::class, 'update_product' ]);

            //delete product
            Route::get('delete/{id}',[ProvidersController::class ,'delete_product' ]);

            //add details
            Route::post('add/details/{id}',[ProvidersController::class , 'store_details']);

            

        });
        
        //order 
        Route::get('orders',[ProvidersController::class , 'orders']);
        Route::get('show/order/{id}', [ProvidersController::class ,'showOrder']);

        Route::post('logout', [ProviderAuthController::class, 'logout'])
                        ->name('provider.logout');
    });

});  


