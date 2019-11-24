<?php

//静态页面
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

//用户
Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

//登录退出
Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

//激活token
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
