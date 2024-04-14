<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [pagesController::class, 'index']);
Route::get('/about-us', [pagesController::class, 'about']);
Route::get('/contact-us', [pagesController::class, 'contact']);
Route::get('/services', [pagesController::class, 'service']);
Route::get('/menu', [FoodController::class, 'create'])->name('menu');
Route::post('/menu', [FoodController::class, 'store']);
Route::get('/booking', [BookingController::class, 'create'])->name('booking');
Route::post('/booking', [BookingController::class, 'store']);


Route::group(['middleware' => ['auth', 'verified']], function(){
    Route::get('/cart', [CartController::class, 'create'])->name('cart');
    Route::post('/cart', [CartController::class, 'store']);
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cartRemove');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cartUpdate');
    Route::get('/checkout', [pagesController::class, 'checkout']);
    Route::post('/order', [OrderController::class, 'store'])->name('order');
});

// Route::get('/dashboard', function () {
//     return view('portal.index');
// })->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
