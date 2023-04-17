<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuth\AuthenticatedSessionController;
use App\Http\Controllers\CkeckOut;
use App\Http\Controllers\CkeckOutController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\frontend\ReviewController;
use App\Http\Controllers\frontend\UserController;
use App\Http\Controllers\FrontendController;

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

Route::middleware('auth')->group(function () 
{
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy']) ->name('logout');
   

    //cart
    Route::get('carts',[FrontendController::class ,'cart' ])->name('allcart');
    //add to card
    Route::post('add/cart/product/{id}',[FrontendController::class , 'addToCart' ])->name('add.product.cart');
    //edite 
    Route::get('edite/cart/{id}',[FrontendController::class , 'edite_cart'])->name('edite.cart');
    Route::post('update/cart/{id}',[FrontendController::class , 'update_cart'])->name('update.cart');

    //delete cart
    Route::get('delete/cart/{id}',[FrontendController::class ,'delete_cart'])->name('delete.cart');

    //wishlist
    Route::get('wishlist',[FrontendController::class ,'wishlist' ])->name('wishlist');
    //add wishlist
    Route::get('add/wishlist/product/{id}',[FrontendController::class , 'add_wishlist' ])->name('add.product.add_wishlist');
    //delete wishlist
    Route::get('delete/wish/{id}',[FrontendController::class ,'delete_wish'])->name('delete.wish');

    //checkout
    Route::get('ckeckout',[CheckoutController::class , 'index'])->name('ckeckout');

    //placeorder
    Route::post('placeOrder',[CheckoutController::class ,'placeorder'])->name('place_order');

    //orders
    Route::get('orders',[UserController::class ,'index'])->name('orders');
    //view order
    Route::get('show/order/{id}', [UserController::class ,'showOrder'])->name('show.order');

    //payment
    Route::get('payment/{totalprice}',[CheckoutController::class ,'select_payment'])->name('select.payment');
    Route::post('stripe/{totalprice}', [CheckoutController::class ,'stripePost'])->name('stripe.post');

    //Rateing_product
    Route::post('rating/{product_id}',[UserController::class ,'rating_product'])->name('save.rating');

    //search
    Route::get('search',[UserController::class, 'search'])->name('search.all');

    //review
    Route::get('review/{product_id}',[ReviewController::class ,'add'])->name('add.review');
    Route::post('save/review/{product_id}',[ReviewController::class ,'store'])->name('store.review');

                
});

require __DIR__.'/client_auth.php';





