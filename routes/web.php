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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('home.index', []);
})->name('home.index');

Route::get('/contact', function () {
    return view('home.contact');
})->name('home.contact');

Route::get('/posts/{id}', function ($id) {
    return 'Blog post '. $id;
})->name('posts.show');

Route::get('/recent-posts/{days_ago?}', function ($days_ago = 20) {
    return 'Posts from '. $days_ago . ' days ago' ;
})->name('posts.recent.index');
