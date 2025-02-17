<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/',[PostController::class,"index"])->name("posts.index");

Route::get('/add',[PostController::class,"create"])->name("posts.create");

Route::post("/",[PostController::class,"store"])->name("posts.store");

Route::get('/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/update/{id}', [PostController::class, 'update'])->name('posts.update');

Route::delete('/posts/{id}',[PostController::class,"destroy"])->name("posts.destroy");

Route::get('/show/{id}',[PostController::class,"show"])->name("posts.show");





