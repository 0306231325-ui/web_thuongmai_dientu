<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\YeuThichController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Liên hệ
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');

// Yêu thích
Route::get('/yeu-thich', [YeuThichController::class, 'index'])
    ->name('yeuthich.index');

Route::delete('/yeu-thich/{id}', [YeuThichController::class, 'destroy'])
    ->name('yeuthich.delete');

// Khuyến mãi Tết
Route::get('/khuyen-mai/tet-2026', function () {
    return view('promotions.tet2026');
});

// Shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/danh-muc/{slug}', [ShopController::class, 'index'])->name('shop.danhmuc');

// Sản phẩm
Route::get('/san-pham/{slug}', [SanPhamController::class, 'show'])
    ->name('sanpham.chitiet');

// Giỏ hàng
Route::prefix('gio-hang')->group(function () {
    Route::get('/', [GioHangController::class, 'index'])
        ->name('gio-hang');

    Route::post('/add/{maBienThe}', [GioHangController::class, 'add'])
        ->name('giohang.add');

    Route::post('/update/{maBienThe}', [GioHangController::class, 'update'])
        ->name('giohang.update');

    Route::post('/remove/{maBienThe}', [GioHangController::class, 'remove'])
        ->name('giohang.remove');
});

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Admin (cần đăng nhập)
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', fn () => 'Trang Admin')->name('admin.dashboard');
});
