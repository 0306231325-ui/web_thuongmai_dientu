<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\YeuThichController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');



Route::get('/yeu-thich', [YeuThichController::class, 'index'])
    ->name('yeuthich.index');

Route::delete('/yeu-thich/{id}', [YeuThichController::class, 'destroy'])
    ->name('yeuthich.delete');

    
Route::get('/khuyen-mai/tet-2026', function () {
    return view('promotions.tet2026');
});
