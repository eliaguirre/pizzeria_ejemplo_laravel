<?php


Route::get('/admin/users', 'Admin\UsersController@index')->name('admin_users');


Route::get('/admin/users/list', 'Admin\UsersController@list');
Route::post('/admin/users/add', 'Admin\UsersController@add');
Route::post('/admin/users/delete', 'Admin\UsersController@delete');
