<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\CategoryTypesController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\SuppliersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Supplier\ContactsController;
use App\Http\Controllers\Supplier\DashboardController as SupplierDashboardController;
use App\Http\Controllers\Supplier\OrdersController as SupplierOrdersController;
use App\Http\Controllers\Supplier\ProductImagesController;
use App\Http\Controllers\Supplier\ProductsController as SupplierProductsController;
use App\Http\Controllers\Supplier\ProfileController;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoriesController::class);
    Route::resource('category_types', CategoryTypesController::class);
    Route::resource('countries', CountriesController::class);
    Route::resource('orders', OrdersController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('suppliers', SuppliersController::class);
    Route::resource('users', UsersController::class);
});


Route::prefix('supplier')->name('supplier.')->middleware(['auth', 'role:supplier'])->group(function () {
    Route::get('/', [SupplierDashboardController::class, 'index'])->name('dashboard');

    Route::resource('orders', SupplierOrdersController::class);
    Route::resource('products', SupplierProductsController::class);
    Route::resource('profile', ProfileController::class);
    Route::resource('contacts', ContactsController::class);
    Route::delete('/images/{id}/delete', [ProductImagesController::class, 'deleteImage'])->name('delete-image');
});

Route::prefix('ajax')->name('ajax.')->group(function () {
    Route::get('header-category', [AjaxController::class, 'headerCategory'])->name('header-category');
    Route::get('header-product', [AjaxController::class, 'headerProduct'])->name('header-product');
    Route::get('filter-country', [AjaxController::class, 'filterCountry'])->name('filter-country');
    Route::get('header-cart', [AjaxController::class, 'headerCart'])->name('header-cart');
    Route::get('supplier-category', [AjaxController::class, 'supplierCatogory'])->name('supplier-category');
    Route::get('message-receiver', [AjaxController::class, 'messageReceiver'])->name('message-receiver');
    Route::get('message-sender', [AjaxController::class, 'messageSender'])->name('message-sender');
});

Route::prefix('search')->name('search.')->group(function () {
    Route::get('/', [SearchController::class, 'index'])->name('index');
    Route::get('all-suppliers', [SearchController::class, 'suppliers'])->name('all-suppliers');
});

Route::get('login', [LoginController::class, 'showLogin'])->name('login');
Route::post('checkLogin', [LoginController::class, 'checkLogin'])->name('checkLogin');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [LoginController::class, 'showRegister'])->name('register');
Route::post('checkRegister', [LoginController::class, 'checkRegister'])->name('checkRegister');
Route::post('reset-password', [LoginController::class, 'resetPassword'])->name('reset-password');

// prefix('customer')->name('customer.')->
Route::middleware(['auth', 'role:customer'])->group(function () {
    Route::get('cart', [AuthController::class, 'cart'])->name('cart');
    Route::post('add-to-cart', [AuthController::class, 'addToCart'])->name('add-to-cart');
    Route::post('remove-out-cart/{id}', [AuthController::class, 'removeOutCart'])->name('remove-out-cart');
    Route::post('change-quantity-cart/{id}', [AuthController::class, 'changeQuantityCart'])->name('change-quantity-cart');
    Route::get('orders', [AuthController::class, 'orders'])->name('orders');
    Route::get('order/{id}', [AuthController::class, 'order'])->name('order');
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('favorite', [AuthController::class, 'favorite'])->name('favorite');
    Route::get('checkout', [AuthController::class, 'checkout'])->name('checkout');
    Route::post('add-to-favorite', [AuthController::class, 'addToFavorite'])->name('add-to-favorite');
    Route::post('remove-out-favorite/{id}', [AuthController::class, 'removeOutFavorite'])->name('remove-out-favorite');
    Route::post('check-order', [AuthController::class, 'checkOrder'])->name('check-order');
    Route::post('cancel-order/{id}', [AuthController::class, 'cancelOrder'])->name('cancel-order');
    Route::post('product-review', [AuthController::class, 'productReview'])->name('product-review');
    Route::post('update-name-user', [AuthController::class, 'updateNameUser'])->name('update-name-user');
    Route::post('update-address-user', [AuthController::class, 'updateAddressUser'])->name('update-address-user');
});
Route::post('send-message', [MessageController::class, 'sendMessage'])->name('send-message');
Route::post('send-supplier', [MessageController::class, 'sendSupplier'])->name('send-supplier');
Route::post('send-customer', [MessageController::class, 'sendCustomer'])->name('send-customer');

Route::get('product/{id}', [PagesController::class, 'product'])->name('product');
Route::get('supplier/{id}', [PagesController::class, 'supplier'])->name('supplier');
Route::get('category/{id}', [PagesController::class, 'category'])->name('category');

Route::get('supplier/{id}', [PagesController::class, 'supplier'])->name('supplier');
Route::get('supplier/{id}/product', [PagesController::class, 'supplierProducts'])->name('supplier-product');
Route::get('supplier/{id}/contacts', [PagesController::class, 'supplierContacts'])->name('supplier-contacts');
Route::post('check-supplier-contacts', [PagesController::class, 'checkSupplierContacts'])->name('check-supplier-contacts');

Route::get('/', [PagesController::class, 'index'])->name('index');
