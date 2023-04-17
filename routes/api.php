<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\user\CheckoutController;
use App\Http\Controllers\Api\user\ReviewController;
use App\Http\Controllers\Api\user\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



    
Route::post('register', [AuthController::class, 'register']);

//login
Route::post('login',[AuthController::class ,'login']);

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


Route::middleware('auth:api')->group(function () 
{
   
    Route::get('logout', [AuthController::class, 'logout']);

    Route::prefix('Carts')->group(function(){
   
        //cart
        Route::get('/',[userController::class ,'cart' ]);
        //add to card
        Route::post('add/products/{id}',[userController::class , 'addToCart' ]);
        //edite 
        Route::post('update/products/{id}',[userController::class , 'update_cart']);

        //delete cart
        Route::get('delete/products/{id}',[userController::class ,'delete_cart']);
    });
    
    Route::prefix('WishList')->group(function(){
         //wishlist
        Route::get('/',[userController::class ,'wishlist' ]);
        //add wishlist
        Route::get('add/products/{id}',[userController::class , 'add_wishlist' ]);
        //delete wishlist
        Route::get('delete/products/{id}',[userController::class ,'delete_wish']);

    });

   
    //checkout
    Route::get('ckeckouts',[CheckoutController::class , 'index']);

    //placeorder
    Route::post('placeOrders',[CheckoutController::class ,'placeorder']);

    //orders
    Route::get('orders',[userController::class ,'orders']);
    //view order
    Route::get('show/orders/{id}', [userController::class ,'showOrder']);

    //payment
    Route::post('stripe/{totalprice}', [CheckoutController::class ,'stripePost']);

    //Rateing_product
    Route::post('rating/{product_id}',[userController::class ,'rating_product']);

    //search
    Route::get('search',[userController::class, 'search']);

    //review
    Route::post('save/reviews/{product_id}',[ReviewController::class ,'store']);

                
});

