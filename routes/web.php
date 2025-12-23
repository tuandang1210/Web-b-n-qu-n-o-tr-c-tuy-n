<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\ProductController;
use App\Http\Controllers\Customer\CustomerController;


use App\Http\Controllers\Auth\AuthController;

Route::get('/', [AuthController::class, 'showLogin']);
Route::post('/', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::post('/products/add', [AdminController::class, 'addProduct'])->name('admin.products.add');
    Route::post('/products/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');
    Route::put('admin/products/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');

    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/users/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::post('/admin/users/{id}/toggle-role', [AdminController::class, 'toggleRole'])->name('admin.users.toggleRole');

    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/orders/confirm/{id}', [AdminController::class, 'confirmOrder'])->name('admin.order.confirm');
    
    
});

Route::prefix('customer')->group(function () {
    Route::get('/', [CustomerController::class, 'homepage'])->name('customer.homepage');

    Route::get('/contact', [CustomerController::class, 'contact'])->name('customer.contact');

    Route::get('/checkout', [CustomerController::class, 'checkout'])->name('customer.checkout');

    Route::get('/cart', [CustomerController::class, 'cart'])->name('customer.cart');

    Route::get('/shop', [CustomerController::class, 'shop'])->name('customer.shop');

    Route::get('/product/{id}', [CustomerController::class, 'sproduct'])->name('customer.sproduct');

    Route::get('/blog', [CustomerController::class, 'blog'])->name('customer.blog');

    Route::delete('/cart/{product_id}/{size}', [CustomerController::class, 'remove'])->name('customer.cart.remove');

    Route::post('/product/{id}/add-to-cart', [ProductController::class, 'addToCart'])->name('product.addToCart');

    Route::post('/checkout', [CustomerController::class, 'placeOrder'])->name('customer.checkout.place');

    Route::get('/my-orders', [CustomerController::class, 'myOrders'])->name('customer.orders');

    Route::post('/contact-send', [CustomerController::class, 'send'])->name('contact.send');
});




