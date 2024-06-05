<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CommentsController;

use App\Http\Controllers\UserssController;

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

Route::get('/', function () {
    return view('master');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/after_register', function () {
    return view('Admin.after_register');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('dashboard',DashboardController::class)->middleware('auth');

Route::resource('categories',CategoriesController::class)->middleware('auth');
// Route::get('kategori-edit/{id}', [KategoriController::class,'edit']);
Route::get('categories-pdf', [CategoriesController::class,'categoriesPDF'])->middleware('auth');
Route::get('categories-excel', [CategoriesController::class,'categoriesExcel'])->middleware('auth');

Route::resource('posts',PostsController::class)->middleware('auth');
// Route::get('menu-edit/{id}', [MenuController::class,'edit']);
Route::get('posts-pdf', [PostsController::class,'postsPDF'])->middleware('auth');
Route::get('posts-excel', [PostsController::class,'postsExcel'])->middleware('auth');


Route::resource('comments',CommentsController::class);
// Route::get('pesanan-edit/{id}', [PesananController::class,'edit']);
Route::get('comments-pdf', [CommentsController::class,'commentsPDF']);
Route::get('comments-excel', [CommentsController::class,'commentsExcel']);


Route::resource('kelola_user',UserssController::class)->middleware('peran:Admin');
Route::get('kelola_user-pdf', [UserssController::class,'kelola_userPDF'])->middleware('peran:Admin');
Route::get('kelola_user-excel', [UserssController::class,'kelola_userExcel'])->middleware('peran:Admin');


Route::get('/access-denied', function () {
    return view('Admin.access_denied');
})->middleware('auth');