<?php

use App\Http\Controllers\frontend\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Provider\OrdersController;
use App\Http\Controllers\Provider\ProductDetailsController;
use App\Http\Controllers\Provider\ProductsController;
use App\Http\Controllers\Provider\ProviderController;
use App\Http\Controllers\ProviderAuth\RegisteredUserController;
use App\Http\Controllers\ProviderAuth\AuthenticatedSessionController;
use App\Http\Controllers\ProviderAuth\AuthenticatedSessionController as ProviderAuthAuthenticatedSessionController;


/*
|--------------------------------------------------------------------------
| provider Routes
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

Route::get('/dashboard',[FrontendController::class ,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('view/product/{id}',[FrontendController::class ,'show_product'])->name('show.products');


Route::namespace('provider')->prefix('provider')->name('provider.')->group( function() 
{
    Route::namespace('Auth')->group(function(){
        
        Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
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

    Route::prefix('products')->group(function()
    {
        //craete products

        Route::get('add' ,[ProductsController::class , 'add'])->name('add.products');
        Route::post('store',[ProductsController::class , 'store'])->name('store.products');

        //edite product
        Route::get('edite/{id}',[ProductsController::class ,'edite'])->name('edite.product');
        Route::post('update/{id}',[ProductsController::class, 'update' ])->name('upadet.product');

        //delete product
        Route::get('delete/{id}',[ProductsController::class ,'delete' ])->name('delete.product');

        //add details
        Route::get('details/{id}',[ProductsController::class ,'show'])->name('add.product.details');

        Route::get('show/{id}',[ProductDetailsController::class ,'show'])->name('show.details');

        Route::post('store/{id}',[ProductDetailsController::class , 'store'])->name('store.details');

        

    });
    
    //order 
    Route::get('orders',[OrdersController::class , 'index'])->name('pallorders');
    Route::get('show/order/{id}', [OrdersController::class ,'show'])->name('pshow.order');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                    ->name('provider.logout');
});

// require __DIR__.'/provider_auth.php';