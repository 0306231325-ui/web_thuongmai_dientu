<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\YeuThichController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonHangController;
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
    
// Giỏ hàng (cần đăng nhập)
Route::middleware('auth')->group(function () {
    Route::get('/gio-hang', [GioHangController::class, 'index'])
        ->name('gio-hang');

    Route::post('/gio-hang/add/{maBienThe}', [GioHangController::class, 'add'])
        ->name('gio-hang.add');

    Route::post('/gio-hang/update/{maBienThe}', [GioHangController::class, 'update'])
        ->name('gio-hang.update');

    Route::delete('/gio-hang/remove/{maBienThe}', [GioHangController::class, 'remove'])
        ->name('gio-hang.remove');
});





Route::post(
    '/ajax/gio-hang/add/{maBienThe}',
    [GioHangController::class, 'addAjax']
)->name('giohang.add.ajax');


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
// Tài khoản người dùng (cần đăng nhập)
Route::middleware('auth')->group(function () {

    Route::get('/tai-khoan', [AuthController::class, 'showProfile'])
        ->name('profile');

    Route::post('/tai-khoan', [AuthController::class, 'updateProfile'])
        ->name('profile.update');

});



Route::middleware(['auth'])->group(function () {
    Route::get('/don-hang', [DonHangController::class, 'index'])->name('donhang.index');
    Route::get('/don-hang/{id}', [DonHangController::class, 'show'])->name('donhang.show');
    Route::post('/don-hang/{id}/huy', [DonHangController::class, 'cancel'])->name('donhang.cancel');
});
