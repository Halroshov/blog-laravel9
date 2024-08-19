<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaticPagesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SessionsController;

// 定义首页路由，指向StaticPagesController的home方法，并命名为home
Route::get('/', [StaticPagesController::class, 'home'])->name('home');

// 定义帮助页面路由，指向StaticPagesController的help方法，并命名为help
Route::get('help', [StaticPagesController::class, 'help'])->name('help');

// 定义关于页面路由，指向StaticPagesController的about方法，并命名为about
Route::get('about', [StaticPagesController::class, 'about'])->name('about');

// 定义注册页面路由，指向UsersController的create方法，并命名为signup
Route::get('signup', [UsersController::class, 'create'])->name('signup');


// 用户资源路由，定义了用户相关的所有RESTful资源路由
Route::resource('users', UsersController::class);

// 定义登录页面路由，指向SessionsController的create方法，并命名为login
Route::get('login', [App\Http\Controllers\SessionsController::class, 'create'])->name('login');

// 定义登录请求路由，指向SessionsController的store方法，并命名为login
Route::post('login', [App\Http\Controllers\SessionsController::class, 'store'])->name('login');

// 定义登出请求路由，指向SessionsController的destroy方法，并命名为logout
Route::delete('logout', [SessionsController::class, 'destroy'])->name('logout');

Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
// 显示密码重设页面, 填写 Email 的表单
Route::get('password/reset', 'PasswordController@showLinkRequestForm')->name('password.request');
// 发送密码重设邮件, 处理表单提交，成功的话就发送邮件，附带 Token 的链接
Route::post('password/email', 'PasswordController@sendResetLinkEmail')->name('password.email');
// 密码更新页面, 显示更新密码的表单，包含 token
Route::get('password/reset/{token}', 'PasswordController@showResetForm')->name('password.reset');
// 执行密码更新操作, 对提交过来的 token 和 email 数据进行配对，正确的话更新密码
Route::post('password/reset', 'PasswordController@reset')->name('password.update');

// 微博的创建和删除
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);
// 相当于定义了
// Route::post('/statuses', 'StatusesController@store')->name('statuses.store');
// Route::delete('/statuses/{status}', 'StatusesController@destroy')->name('statuses.destroy')