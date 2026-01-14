<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\YeuThichController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\GioHangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DanhGiaController;
use App\Http\Controllers\CheckoutController; 
use App\Http\Controllers\DonHangController;


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');


Route::get('/khuyen-mai/tet-2026', fn () => view('promotions.tet2026'));



Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/danh-muc/{slug}', [ShopController::class, 'index'])
    ->name('shop.danhmuc');



Route::post('/danh-gia', [DanhGiaController::class, 'store'])
    ->name('danhgia.store')
    ->middleware('auth');

Route::delete('gio-hang/clear', [GioHangController::class, 'clear'])
    ->name('gio-hang.clear');



Route::get('/san-pham/{slug}', [SanPhamController::class, 'show'])
    ->name('sanpham.chitiet');



Route::middleware('auth')->group(function () {
    Route::get('/yeu-thich', [YeuThichController::class, 'index'])
        ->name('yeuthich.index');

    Route::delete('/yeu-thich/{id}', [YeuThichController::class, 'destroy'])
        ->name('yeuthich.delete');
});





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




Route::middleware('auth')->group(function () {

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');

    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');

    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])
        ->name('checkout.success');
});


Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');


// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register']);



// Route::middleware('auth')->group(function () {
//     Route::get('/admin', fn () => 'Trang Admin')
//         ->name('admin.dashboard');
// });


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

