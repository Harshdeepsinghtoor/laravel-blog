<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcomes');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/singh', function () {
    return view('harshdeep', ['name' => 'Unknown Names']);
});
Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);
Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);
Route::post('/blog', [\App\Http\Controllers\BlogPostController::class, 'ajax'])->name('blogposts.store');
// Route::get('/example', [\App\Http\Controllers\BlogPostController::class, 'example']);



Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']); //shows create post form
Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']); //saves the created post to the databse
Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']); //shows edit post form
Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']); //commits edited post to the database 
Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy']); //deletes post from the database

// Routes for the uses Front
Route::get('/front', [\App\Http\Controllers\BlogPostController::class, 'front']);
Route::post('/front', [\App\Http\Controllers\BlogPostController::class, 'frontajax']);
Route::get('/front/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'frontshows']);
Route::get('/front/category/{category}', [\App\Http\Controllers\BlogPostController::class, 'filtercategory']);


// Routes for the uses Category
Route::get('/category', [\App\Http\Controllers\BlogCategoryController::class, 'index']);
Route::get('/blog/create/category', [\App\Http\Controllers\BlogCategoryController::class, 'create']);
Route::post('/blog/create/category', [\App\Http\Controllers\BlogCategoryController::class, 'store']);
Route::get('/category/{blogCategory}/edit', [\App\Http\Controllers\BlogCategoryController::class, 'edit']);
Route::put('/category/{blogCategory}/edit', [\App\Http\Controllers\BlogCategoryController::class, 'update']);
Route::delete('/category/{blogCategory}', [\App\Http\Controllers\BlogCategoryController::class, 'destroy']);

//Sample
