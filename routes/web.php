<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\PostController;
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

// Route::get('/', [PostController::class,'index'])->name('posts.index');
// Route::get('posts/{post}', [PostController::class,'show'])->name('posts.show');
/*Route::controller(HomeController::class)->group(function(){
    Route::get('/','index')->name('posts.index');
    Route::get('posts/{post}','show')->name('posts.show');
    Route::get('category/{category}','category')->name('posts.category');
    Route::get('tag/{tag}','tag')->name('posts.tag');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});*/
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('',[HomeController::class,'index'], function () {
        return view('admin.home');
    })->name('admin.home');
});