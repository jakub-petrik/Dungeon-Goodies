<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\CombinedAuthController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ShoppingCartController;

Route::resource('users', UserController::class);

Route::get('/', [MainPageController::class, 'showMainPage'])->name('main');
//Route::view('/shopping-cart', 'layouts.Shopping_Cart')->name('shopping-cart');
//Route::view('/product-page', 'layouts.Product_Page')->name('product-page');
//Route::view('/sales', 'layouts.Sales')->name('sales');
Route::view('/sign-in-register', 'layouts.SignIn_Register')->name('sign-in-register');
Route::view('/admin-page', 'layouts.Admin_Page')->name('admin-page');
//Route::view('/product-detail', 'layouts.Product_Detail')->name('product-detail');
Route::view('/delivery', 'layouts.Delivery')->name('delivery');
Route::view('/payment', 'layouts.Payment')->name('payment');
Route::view('/payment-success', 'layouts.Payment_Succeeded_Page')->name('payment-success');

// Login/register
Route::post('/auth-combined', [CombinedAuthController::class, 'authenticate'])->name('auth.combined');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('main');
})->name('logout');

Route::get('/favourites', function () {
    $user = auth()->user(); // Get the authenticated user
    $favourites = $user->favourites; // Retrieve the user's favourite items
    return view('layouts.Favourites', ['favourites' => $favourites]);
})->middleware('auth')->name('favourites');

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

// Products
Route::get('/product-page', [ProductController::class, 'index'])->name('product-page');
Route::get('/sales', [SaleController::class, 'index'])->name('sales');
//Route::get('/product/{id}', [\App\Http\Controllers\ProductController::class, 'show'])->name('product-detail');
Route::get('/product/{id}', [ProductController::class, 'show'])
    ->where('id', '[0-9]+')
    ->name('product-detail');

// Shopping Cart
Route::post('/add-to-cart', [ShoppingCartController::class, 'add'])->name('cart.add');
Route::get('/shopping-cart', [ShoppingCartController::class, 'show'])->name('shopping-cart');
Route::get('/login', function () {
    return redirect()->route('sign-in-register');
})->name('login');
Route::post('/remove-from-cart/{id}', function ($id) {
    $cart = session()->get('cart', []);
    unset($cart[$id]);
    session()->put('cart', $cart);

    return redirect()->route('shopping-cart');
})->name('cart.remove.guest');
Route::post('/cart/update/{id}', [ShoppingCartController::class, 'update'])->name('cart.update');

// Favourite
Route::post('/favourites/toggle', [\App\Http\Controllers\FavouriteController::class, 'toggle'])->name('favourites.toggle')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
