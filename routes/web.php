<?php

//use Illuminate\Support\Facades\Route;

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


// blog
Route::get('/blog',function (){
    dd('blog');
})->name('blog');
// store
Route::get('/store',function (){
    dd('store');
})->name('store');
//
Route::get('/news',function (){
    dd('news');
})->name('news');


Route::get('/{country?}', 'Site\Index@index')->middleware('geo')->name('board');

// adds

















