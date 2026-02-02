<?php

use App\Http\Controllers\AllProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListUserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductsController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserdashController;
use Illuminate\Support\Facades\Route;






// Dashboard - page d'accueil après connexion
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
   Route::put('/admin/orders/{id}/status', [OrderController::class, 'updateStatus'])
    ->name('admin.orders.updateStatus');

});

// Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
//      Route::get('/orders', [OrderController::class, 'store'])->name('orders.store');
// });
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
     Route::get('/list-orders', [OrderController::class, 'index'])->name('orders.list');
});
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
       Route::get('/reviews', [ReviewController::class, 'indexAdmin'])->name('admin.reviews');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::middleware(['auth', 'verified'])->prefix('user')->group(function () {
    Route::get('/dashboard', [UserdashController::class, 'index'])->name('user.dashboard');
    Route::get('/profil', [UserdashController::class, 'profil'])->name('user.profil');
});

Route::get('/admin/users', [ListUserController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{user}/block', [ListUserController::class, 'toggleBlock'])->name('admin.users.block');
    Route::post('/admin/users/{user}/contact', [ListUserController::class, 'contact'])->name('admin.users.contact');


// Profil utilisateur
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour les catégories
Route::middleware(['auth'])->prefix('admin/categories')->group(function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('list.category');
    Route::get('/create', [CategoriesController::class, 'create'])->name('create.category');
    Route::post('/', [CategoriesController::class, 'store'])->name('store.category');
    Route::get('/{id}/edit', [CategoriesController::class, 'edit'])->name('edit.category');
    Route::post('/{id}', [CategoriesController::class, 'update'])->name('update.category');
    Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('destroy.category');
    Route::get('/category/{id}', [CategoriesController::class, 'show'])->name('category.show');
});

// Routes pour les produits
// use App\Http\Controllers\ProductController; // Ajout du contrôleur public


//  Tes routes d'administration existantes (à ne pas toucher)
Route::middleware(['auth'])->prefix('admin/products')->group(function () {
    Route::get('/', [ProductsController::class, 'index'])->name('list.product');
    Route::get('/create', [ProductsController::class, 'create'])->name('create.product');
    Route::post('/', [ProductsController::class, 'store'])->name('store.product');
    Route::get('/{id}/edit', [ProductsController::class, 'edit'])->name('edit.product');
    Route::post('/{id}', [ProductsController::class, 'update'])->name('update.product');
    Route::delete('/{id}', [ProductsController::class, 'destroy'])->name('destroy.product');
    Route::get('/product/{id}', [ProductsController::class, 'show'])->name('product.show');
});

//Acceuil pour les produits
Route::get('/', [ProductsController::class, 'home'])->name('home');

// Like / Unlike d’un produit (auth requis)
Route::post('/products/{product}/like', [ProductsController::class, 'like'])
    ->middleware('auth')
    ->name('products.like');

//  Ajout au panier (auth requis)
Route::post('/products/{product}/add-to-cart', [ProductsController::class, 'addToCart'])
    ->middleware('auth')
    ->name('products.addToCart');

    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour gérer la photo de profil
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::delete('/profile/photo', [ProfileController::class, 'deletePhoto'])->name('profile.deletePhoto');
});

// show cart  
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
// Route::get('/cart/order', [CartController::class, 'order'])->name('cart.order');

//category home

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/cat', [HomeController::class, 'indexs'])->name('home.cate');
Route::get('/All-Product', [AllProductController::class, 'homes'])->name('all.product');


//login


 Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    
Route::middleware('auth')->group(function () {
   Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
    
Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
     Route::get('/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
     
});

Route::get('/search-suggestions', [ProductsController::class, 'suggestions']);
Route::post('/reviews/{id}/like', [ReviewController::class, 'like'])
    ->name('reviews.like');
//commande users
Route::middleware('auth')->get('/mes-commandes', [OrderController::class, 'userOrders'])
    ->name('user.orders');

    Route::delete('/mes-commandes/delete-all', [OrderController::class, 'deleteAll'])
    ->middleware('auth')
    ->name('user.orders.deleteAll');





// Auth routes générées par Laravel Breeze ou Jetstream
require __DIR__.'/auth.php';
