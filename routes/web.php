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
Route::get('/', function () {
    return redirect('home');
});
Route::get('/home', [\App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::get('/blog/{id}', [\App\Http\Controllers\HomeController::class,'readBlog'])->name('read-blog');

Auth::routes(['verify'=>true]);
Route::group(['middleware' => ['auth','verified']], function() {
    #blog routes
    Route::get('/blogs', [App\Http\Controllers\BlogController::class, 'index'])->name('blogs');
    Route::get('/blogs/save', [App\Http\Controllers\BlogController::class, 'save'])->name('blogs-save');
    Route::get('/blogs/update/{id}', [App\Http\Controllers\BlogController::class, 'update'])->name('blogs-update');

    Route::post('/blogs/insert',[\App\Http\Controllers\BlogController::class,'insert'])->name('blog-insert');
    Route::post('/blogs/edit',[\App\Http\Controllers\BlogController::class,'edit'])->name('blog-edit');
    Route::post('/blogs/delete',[\App\Http\Controllers\BlogController::class,'delete'])->name('blog-delete');
});
