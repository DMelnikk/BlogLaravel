<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

//Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/',[\App\Http\Controllers\PostController::class,'index'])->name('home');
Route::get('/post/{slug}',[\App\Http\Controllers\PostController::class,'show'])->name('posts.single');
Route::get('/search',[\App\Http\Controllers\PostController::class,'search'])->name('posts.search');
Route::get('/category/{slug}',[\App\Http\Controllers\CategoryController::class,'show'])->name('categories.single');
Route::get('/tag/{slug}',[\App\Http\Controllers\TagController::class,'show'])->name('tags.single');
Route::post('/comments',[\App\Http\Controllers\CommentController::class,'store'])->name('comments.store');

Route::get('/contact',[\App\Http\Controllers\ContactController::class,'index'])->name('contact');
Route::post('/contact/send',[\App\Http\Controllers\ContactController::class,'send'])->name('contact.send');




Route::middleware('guest')->group(function () {
    Route::get('/login',[UserController::class,'login'])->name('login');
    Route::post('/login',[UserController::class,'authenticate'])->name('login.authenticate');
});

Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');


Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/',[MainController::class,'index'])->name('admin.main.index');

    // эти маршрутs относится к ресурсному контроллеру , но что-бы маршруты работали , обязательно ставим его выше ресурсного маршрута
    Route::get('/posts/basket',[PostController::class,'basket'])->name('admin.posts.basket');
    Route::get('/posts/basket/{post}/restore',[PostController::class,'basketRestore'])->name('admin.posts.basket.restore');
    Route::delete('/posts/basket/{post}/destroy',[PostController::class,'basketRemove'])->name('admin.posts.basket.remove');

    //

    Route::resource('/categories', CategoryController::class);
    Route::resource('/posts', PostController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/users', \App\Http\Controllers\Admin\UserController::class);

});

