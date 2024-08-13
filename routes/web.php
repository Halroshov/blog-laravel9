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
    return view('welcome');
});
// 首页
Route::get('/', 'StaticPagesController@home')->name('/');

// 帮助页面
Route::get('/help', 'StaticPagesController@help')->name('help');

// 关于页面
Route::get('/about', 'StaticPagesController@about')->name('about');