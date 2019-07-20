<?php

Route::prefix('admin')->group(function () {
    Route::get('/pedidos', function () {
        return view('welcome');
    })->name('admin_orders');
});
