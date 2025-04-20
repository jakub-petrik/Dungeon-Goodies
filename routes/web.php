<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainPageController;

Route::resource('users', UserController::class);

Route::get('/', [MainPageController::class, 'showMainPage'])->name('main');
Route::view('/shopping-cart', 'layouts.Shopping_Cart')->name('shopping-cart');
Route::view('/product-page', 'layouts.Product_Page')->name('product-page');
Route::view('/sales', 'layouts.Sales')->name('sales');
Route::view('/sign-in-register', 'layouts.SignIn_Register')->name('sign-in-register');
Route::view('/admin-page', 'layouts.Admin_Page')->name('admin-page');
Route::view('/product-detail', 'layouts.Product_Detail')->name('product-detail');
Route::view('/delivery', 'layouts.Delivery')->name('delivery');
Route::view('/payment', 'layouts.Payment')->name('payment');
Route::view('/payment-success', 'layouts.Payment_Succeeded_Page')->name('payment-success');

// Admin
Route::get('/admin/add-product', function () {
    return view('layouts.Add_New_Product');
})->name('add-product');

Route::get('/admin/remove-product', function () {
    return view('layouts.Remove_Product_Page');
})->name('remove-product');

Route::get('/admin/edit-product', function () {
    return view('layouts.Edit_Product_Page');
})->name('edit-product');

Route::get('/admin/users-info', function () {
    return view('layouts.Users_Info_Page');
})->name('users-info');

Route::get('/admin/web-statistics', function () {
    return view('layouts.Web_Statistics_Page');
})->name('web-statistics');

Route::get('/edit-product-detail', function () {
    return view('layouts.Edit_Product_Detail_Page');
})->name('edit-product-detail');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
