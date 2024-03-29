<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;


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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(PostController::class)->middleware(['auth'])->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('posts/create', 'create')->name('create');
    Route::post('/posts', 'store')->name('store');
    Route::get('/posts/{post}', 'show')->name('show');
    Route::get('/posts/edit/{post}', 'edit')->name('edit');
    Route::put('/posts/update/{post}', 'update')->name('update');
    Route::delete('/posts/delete/{post}','delete')->name('delete');
    Route::post('/likes/{post}', 'like')->name('post.like');
    Route::post('/unlikes/{post}', 'unlike')->name('post.unlike');
    Route::get('/post/search', 'search')->name('post.search');
    Route::get('/posts/serchs/index', 'searchIndex')->name('search.index');
    Route::post('/posts/read/{notification', 'read')->name('read');
    Route::delete('/posts/image/delete/{post}', 'imageDelete')->name('image_delete');
    Route::get('/draft', 'draft')->name('draft');
    Route::get('/posts/draft/{post}', 'draftEdit')->name('draftedit');
    Route::post('/posts/draft/update/{post}', 'draftUpdate')->name('draftupdate');

});
Route::controller(CommentController::class)->middleware(['auth'])->group(function(){
    Route::post('/comments/store/{post}', 'store')->name('comment.store');
    Route::post('/comments/likes/{comment}', 'commentLike')->name('comment.like');
    Route::post('/comments/unlikes/{comment}', 'commentUnlike')->name('comment.unlike');
});
    

Route::get('/regions/{region}', [RegionController::class, 'index'])->middleware("auth")->name('region');

Route::get('/users/{user}', [UserController::class, 'index'])->middleware("auth")->name('user');

Route::get('users/comment/{user}', [UserController::class, 'commentIndex'])->middleware("auth");

Route::get('/categories/{categories}', [CategoryController::class, 'index'])->middleware("auth")->name('category');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
