<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\PostContoller::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::controller(App\Http\Controllers\PostContoller::class)->prefix('posts')->group(function (){
    Route::get('/', 'index')->name('post.index');
    Route::get('/create', 'create')->name('post.create');
    Route::post('/', 'store')->name('post.store');
    Route::get('/{post}', 'show')->name('post.show');
});
Route::controller(App\Http\Controllers\MyPostsController::class)->prefix('myPosts')->group(function (){
    Route::get('/', 'index')->name('myPost.index');
    Route::get('/{post}/edit', 'edit')->name('myPost.edit');
    Route::patch('/{post}', 'update')->name('myPost.update');
    Route::get('/{post}', 'destroy')->name('myPost.destroy');
});

Route::controller( App\Http\Controllers\CommentController::class)->prefix('comments')->group(function (){
   Route::post('/{post}', 'store')->name('comment.store');
   Route::get('/{comment}/edit', 'edit')->name('comment.edit');
   Route::patch('/{comment}', 'update')->name('comment.update');
   Route::get('/{comment}', 'destroy')->name('comment.destroy');
    Route::get('comment-image/{comment}/delete', 'destroyImage')->name('comment.image.destroy');
});
