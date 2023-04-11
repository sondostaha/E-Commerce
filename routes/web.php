<?php

use App\Http\Controllers\Admin\HandleAdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ProviderAuth\RegisteredUserController;
use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\FrontendController;
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy']) ->name('logout');
                
    //cart
    Route::get('carts',[FrontendController::class ,'cart' ])->name('allcart');
    //add to card
    Route::post('add/cart/product/{id}',[FrontendController::class , 'addToCart' ])->name('add.product.cart');
    //delete cart
    Route::get('delete/cart/{id}',[FrontendController::class ,'delete_cart'])->name('delete.cart');

    //wishlist
    Route::get('wishlist',[FrontendController::class ,'wishlist' ])->name('wishlist');
    //add wishlist
    Route::get('add/wishlist/product/{id}',[FrontendController::class , 'add_wishlist' ])->name('add.product.add_wishlist');
    //delete wishlist
    Route::get('delete/wish/{id}',[FrontendController::class ,'delete_wish'])->name('delete.wish');

                
});

require __DIR__.'/client_auth.php';





