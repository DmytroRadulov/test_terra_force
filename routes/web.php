<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('register');
Route::post('/sign-up-store', [UserController::class, 'store'])->name('site.signUpStore');
Route::post('/auth/login', [UserController::class, 'handleLogin'])->name('auth.handleLogin');
Route::get('/auth/login/view', [UserController::class, 'login'])->name('auth.handleLogin.view');

Route::middleware(['auth'])->group(function () {
Route::get('/auth/logout', [UserController::class, 'logout'])->name('auth.logout');

//Post
Route::get('/post', [PostController::class, 'index'])->name('post');
Route::get('post/create', [PostController::class, 'create'])->name('posts.create');
Route::get('post/{id}', [PostController::class, 'show'])->name('posts.show');
Route::post('post/store', [PostController::class, 'store'])->name('posts.store');
Route::get('post/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('post/update', [PostController::class, 'update'])->name('posts.update');
Route::post('post/{id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
});
