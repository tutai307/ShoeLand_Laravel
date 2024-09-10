<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductSizeController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;

Route::prefix('admin')
    ->name('admin.')
    ->middleware('admin') // Thêm middleware 'admin' để kiểm tra quyền truy cập
    ->group(function () {
        Route::resource('dashboard', DashboardController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class)->only([
            'index', 'create', 'store', 'update', 'destroy'
        ]);
        Route::resource('events', EventController::class)->only([
            'index', 'create', 'store', 'update', 'destroy'
        ]);
        Route::resource('sizes', SizeController::class)->only([
            'index', 'create', 'store', 'update', 'destroy'
        ]);
        Route::resource('statuses', StatusController::class)->only([
            'index', 'create', 'store', 'update', 'destroy'
        ]);
        Route::resource('payments', PaymentController::class)->only([
            'index', 'create', 'store', 'update', 'destroy'
        ]);

        Route::resource('orders', OrderController::class)->only([
            'index', 'update'
        ]);

        Route::resource('users', UserController::class)->only([
            'index', 'create', 'store', 'update', 'destroy'
        ]);
        
        Route::get('product-images/{product_id}', [ProductImageController::class, 'index'])->name('product-images.index');
        Route::post('product-images/{product_id}', [ProductImageController::class, 'store'])->name('product-images.store');
        Route::put('product-images/{image_id}', [ProductImageController::class, 'update'])->name('product-images.update');
        Route::delete('product-images/{image_id}', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

        Route::get('product-sizes/{product_id}', [ProductSizeController::class, 'index'])->name('product-sizes.index');
        Route::post('product-sizes/{product_id}', [ProductSizeController::class, 'store'])->name('product-sizes.store');
        Route::put('product-sizes/{product_id}/{size_id}', [ProductSizeController::class, 'update'])->name('product-sizes.update');
        Route::delete('product-sizes/{product_id}/{size_id}', [ProductSizeController::class, 'destroy'])->name('product-sizes.destroy');
    });
?>
