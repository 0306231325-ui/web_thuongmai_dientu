<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home.index');
});



//Qua Trang admin cua Nam
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');
//quan ly hoa don 
Route::get('/admin/orders', function () {
    return view('admin.orders');
})->name('admin.orders');
//quan ly san pham 
Route::get('/admin/products', function () {
    return view('admin.products');
})->name('admin.products');
//quan ly bình luan 
Route::get('/admin/comments', function () {
    return view('admin.comments');
})->name('admin.comments');
//Loại sản phẩm 
Route::get('/admin/categories', function () {
    return view('admin.categories');
})->name('admin.categories');
