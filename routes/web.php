<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
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

Route::get('/', HomeController::class)->name('home');

Route::get('/sign-up', [RegisterController::class, 'index'])->name('sign-up');
Route::post('/sign-up', [RegisterController::class, 'store']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/editar-perfil', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/editar-perfil', [ProfileController::class, 'store'])->name('profile.store');

Route::get('/{user:username}', [FeedController::class, 'index'])->name('feed.index');
Route::get('/posts/create', [FeedController::class, 'create'])->name('feed.create');
Route::post('/posts', [FeedController::class, 'store'])->name('feeds.store');
Route::get('/{user:username}/posts/{post}', [FeedController::class, 'show'])->name('posts.show');
Route::delete('posts/{post}', [FeedController::class, 'destroy'])->name('post.destroy');

Route::post('/{user:username}/posts/{post}', [CommentController::class, 'store'])->name('comment.store');

Route::post('/images', [ImageController::class, 'store'])->name('image.store');

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

Route::post('/{user:username}/follow}', [FollowerController::class, 'store'])->name('users.follow');
Route::delete('/{user:username}/unfollow}', [FollowerController::class, 'destroy'])->name('users.unfollow');
