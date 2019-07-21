<?php


Route::get('/admin/orders', 'Admin\OrdersController@index')->name('admin_orders');


Route::get('/admin/orders/add', 'Admin\OrdersController@add')->name('admin_orders_add');
