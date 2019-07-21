<?php



Route::get('/venta/pizzas/list', 'PizzasController@list');

Route::post('/venta/order/add', 'PizzasController@create_order');
