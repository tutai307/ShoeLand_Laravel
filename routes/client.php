<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Client\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Controllers\Client\PaymentController as ClientPaymentController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\SearchingController;
use App\Http\Controllers\Client\UserController;

Route::get('/', function () {
    return view('client.home');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');


Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/{product_id}/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');


Route::get('/payment', [OrderController::class, 'index'])->name('payment.index');
// Route để xử lý việc hủy đơn hàng từ phía người dùng
Route::post('/orders/{order}/cancel', [OrderController::class, 'cancelUserOrder'])->name('orders.cancel');

Route::post('/payment', [ClientPaymentController::class, 'handle'])->name('payment.handle');
Route::get('/payment-done', [ClientPaymentController::class, 'thanks'])->name('payment.thanks');

Route::get('/info', [UserController::class, 'viewInfo'])->name('info.view');
Route::post('/info', [UserController::class, 'updateInfo'])->name('info.update');

Route::post('/send-mail/{id}', [OrderController::class, 'sendMail'])->name('orders.sendMail');

Route::get('/searching', [SearchingController::class, 'index'])->name('searching.index');


?>