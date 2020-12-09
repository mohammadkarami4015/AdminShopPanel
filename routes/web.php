<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Shop\DiscountController;
use App\Http\Controllers\Shop\MessageController;
use App\Http\Controllers\Shop\OrderController;
use App\Http\Controllers\Shop\PaymentsController;
use App\Http\Controllers\Shop\ProductCommentController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\ShopCategoryController;
use App\Http\Controllers\Shop\ShopController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/', function () {

        return view('dashboard');
    })->name('dashboard');

    /**********************************************************ADMIN ROUTE*********************************************/
    Route::patch('/admin/change-password/{admin}', [AdminController::class, 'changePassword'])->name('admin.change-password');

    Route::get('/admin/activate/{id}/{value}', [AdminController::class, 'activate'])->name('admin.activate');

    Route::resource('admin', 'adminController');
    /**********************************************************CITY ROUTE*********************************************/
    Route::resource('city', 'CityController');

    /**********************************************************GROUP ROUTE*********************************************/
    Route::resource('group', 'GroupController');

    /**********************************************************SUBGROUP ROUTE*********************************************/
    Route::resource('subgroup', 'SubgroupController');

    /**********************************************************SUBGROUP ROUTE*********************************************/
    Route::prefix('products')->group(function () {

        Route::get('', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');

        Route::get('/{product}', [\App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
    });

    /**********************************************************PAYMENT ROUTE*********************************************/
    Route::get('/payments', [PaymentController::class, 'index'])->name('payment.index');

    /**********************************************************SUBGROUP ROUTE*********************************************/
    Route::get('/message', [\App\Http\Controllers\MessageController::class, 'index'])->name('message.index');

    /**********************************************************SHOP ROUTE*********************************************/
    Route::prefix('/shops')->group(function () {

        Route::get('/activate/{id}/{value}', [ShopController::class, 'activate'])->name('shop.activate');

        Route::get('/', [ShopController::class, 'index'])->name('shop.index');

        Route::prefix('/{shop}')->group(function () {

            Route::get('', [ShopController::class, 'details'])->name('shop.details');

            Route::get('/edit', [ShopController::class, 'edit'])->name('shop.edit');

            Route::patch('', [ShopController::class, 'update'])->name('shop.update');

            Route::delete('/', [ShopController::class, 'destroy'])->name('shop.delete');

            Route::delete('/delete-photo', [ShopController::class, 'deletePhoto'])->name('shop.delete-photo');

            Route::delete('/delete-sendPrice', [ShopController::class, 'deleteSendPrice'])->name('shop.delete-sendPrice');

            Route::post('/create-sendPrice', [ShopController::class, 'createSendPrice'])->name('shop.create-sendPrice');

            Route::post('/add-photo', [ShopController::class, 'addPhoto'])->name('shop.add-photo');

            Route::post('/add-logo', [ShopController::class, 'addLogo'])->name('shop.add-logo');

            Route::post('/working-hours', [ShopController::class, 'workingHour'])->name('shop.workingHour');

            Route::post('/latLang', [ShopController::class, 'updateLatLang'])->name('shop.latLang');

            /**********************************************************PRODUCT ROUTE*********************************************/
            Route::prefix('/product')->group(function () {

                Route::get('/search', [ProductController::class, 'search'])->name('product.search');

                Route::get('/', [ProductController::class, 'index'])->name('product.index');

                Route::get('/create', [ProductController::class, 'create'])->name('product.create');

                Route::post('/', [ProductController::class, 'store'])->name('product.store');

                Route::prefix('/{product}')->group(function () {

                    Route::get('/', [ProductController::class, 'show'])->name('product.show');

                    Route::get('/edit', [ProductController::class, 'edit'])->name('product.edit');

                    Route::patch('/', [ProductController::class, 'update'])->name('product.update');

                    Route::delete('/', [ProductController::class, 'destroy'])->name('product.destroy');

                    Route::post('/features', [ProductController::class, 'addFeature'])->name('product.addFeatures');

                    Route::delete('/features', [ProductController::class, 'deleteFeature'])->name('product.deleteFeatures');

                    Route::post('/photo', [ProductController::class, 'addPhoto'])->name('product.add-photo');

                    Route::delete('/Photo', [ProductController::class, 'deletePhoto'])->name('product.delete-photo');

                    Route::prefix('/productComment')->group(function () {

                        Route::get('/', [ProductCommentController::class, 'index'])->name('productComment.index');

                        Route::get('/reply/{productComment}', [ProductCommentController::class, 'create'])->name('productComment.create');

                        Route::post('/reply/{productComment}', [ProductCommentController::class, 'reply'])->name('productComment.reply');

                        Route::delete('/reply/{productComment}', [ProductCommentController::class, 'destroy'])->name('productComment.destroy');

                        Route::get('/verify/{id}/{value}', [ProductCommentController::class, 'verify'])->name('productComment.verify');
                    });
                });
            });

            /****************************************************************SHOP_CATEGORY ROUTES***********************************************/
            Route::prefix('/shop-categories')->group(function () {

                Route::get('/search', [ShopCategoryController::class, 'search'])->name('shopCategory.search');

                Route::get('/', [ShopCategoryController::class, 'index'])->name('shopCategory.index');

                Route::get('/create', [ShopCategoryController::class, 'create'])->name('shopCategory.create');

                Route::post('/', [ShopCategoryController::class, 'store'])->name('shopCategory.store');

                Route::prefix('/{shopCategory}')->group(function () {

                    Route::get('/edit', [ShopCategoryController::class, 'edit'])->name('shopCategory.edit');

                    Route::patch('/', [ShopCategoryController::class, 'update'])->name('shopCategory.update');

                    Route::delete('/', [ShopCategoryController::class, 'destroy'])->name('shopCategory.destroy');
                });

            });

            /****************************************************************ORDER ROUTE***********************************************/
            Route::prefix('order')->group(function () {

                Route::get('/search', [OrderController::class, 'search'])->name('order.search');

                Route::get('/', [OrderController::class, 'index'])->name('order.index');

                Route::post('/filter', [OrderController::class, 'filterByStatus'])->name('order.filterStatus');

                Route::get('/{order}', [OrderController::class, 'show'])->name('order.show');

                Route::get('/edit/{order}', [OrderController::class, 'edit'])->name('order.edit');

                Route::patch('/{order}', [OrderController::class, 'update'])->name('order.update');
            });

            /****************************************************************DISCOUNT ROUTE***********************************************/
            Route::prefix('/discount')->group(function () {

                Route::get('/search', [DiscountController::class, 'search'])->name('discount.search');

                Route::get('/', [DiscountController::class, 'index'])->name('discount.index');

                Route::get('/create', [DiscountController::class, 'create'])->name('discount.create');

                Route::post('/', [DiscountController::class, 'store'])->name('discount.store');

                Route::prefix('/{discount}')->group(function () {

                    Route::get('/', [DiscountController::class, 'show'])->name('discount.show');

                    Route::get('/edit', [DiscountController::class, 'edit'])->name('discount.edit');

                    Route::patch('/', [DiscountController::class, 'update'])->name('discount.update');

                    Route::delete('/', [DiscountController::class, 'destroy'])->name('discount.destroy');
                });
            });

            /****************************************************************PAYMENT ROUTE***********************************************/
            Route::prefix('payment')->group(function () {

                Route::get('', [PaymentsController::class, 'index'])->name('ShopPayment.index');

            });

            /****************************************************************MESSAGE ROUTE***********************************************/

            Route::prefix('message')->group(function () {

                Route::get('/', [MessageController::class, 'index'])->name('shopMessage.index');

                Route::get('/create', [MessageController::class, 'create'])->name('shopMessage.create');

                Route::post('/', [MessageController::class, 'store'])->name('shopMessage.store');
            });
        });
    });


});
