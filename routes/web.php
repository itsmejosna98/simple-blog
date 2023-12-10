<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\WebsiteController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('login-admin', [LoginController::class, 'index'])->name('login');
Route::post('login-check', [LoginController::class, 'loginCheck'])->name('login.check');

// Route::get('register-user', [LoginController::class, 'register'])->name('register.user');
Route::post('register-submit', [LoginController::class, 'registerSubmit'])->name('register.submit');

Route::get('/', [WebsiteController::class, 'index'])->name('/');
Route::get('article-details/{id}/view', [WebsiteController::class, 'articleDetails'])->name('article.details');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ProfileController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Manage categories 
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories');
    Route::get('/category-create', [CategoriesController::class, 'create'])->name('category.create');
    Route::post('/category-store', [CategoriesController::class, 'store'])->name('category.store');
    Route::get('category/{id}/edit', [CategoriesController::class, 'edit'])->name('category.edit');
    Route::post('/category-update', [CategoriesController::class, 'update'])->name('category.update');
    Route::get('category/{id}/delete', [CategoriesController::class, 'delete'])->name('category.delete');

    // manage Tags
    Route::get('/tags', [TagsController::class, 'index'])->name('tags');
    Route::get('/tag-create', [TagsController::class, 'create'])->name('tag.create');
    Route::post('/tag-store', [TagsController::class, 'store'])->name('tag.store');
    Route::get('tag/{id}/edit', [TagsController::class, 'edit'])->name('tag.edit');
    Route::post('/tag-update', [TagsController::class, 'update'])->name('tag.update');
    Route::get('tag/{id}/delete', [TagsController::class, 'delete'])->name('tag.delete');

    // Manage articles
    Route::get('/articles', [ArticlesController::class, 'index'])->name('articles');
    Route::get('article-create', [ArticlesController::class, 'create'])->name('article.create');
    Route::post('/article-store', [ArticlesController::class, 'store'])->name('article.store');
    Route::get('article/{id}/edit', [ArticlesController::class, 'edit'])->name('article.edit');
    Route::post('/article-update', [ArticlesController::class, 'update'])->name('article.update');
    Route::get('article/{id}/delete', [ArticlesController::class, 'delete'])->name('article.delete');
    Route::get('article/{id}/show', [ArticlesController::class, 'show'])->name('article.show');
});

require __DIR__.'/auth.php';
