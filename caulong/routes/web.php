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
use App\Http\Controllers\KhuyenMaiController;
use App\Http\Controllers\Admin\SanPhamAdminController;
use App\Http\Controllers\Admin\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/lien-he', [ContactController::class, 'index'])->name('contact');
Route::post('/lien-he/gui', [ContactController::class, 'store'])->name('lien-he.gui');
Route::get('/khuyen-mai/tet-2026', fn () => view('promotions.tet2026'));

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
Route::get('/shop/danh-muc/{slug}', [ShopController::class, 'index'])->name('shop.danhmuc');
Route::get('/san-pham/{slug}', [SanPhamController::class, 'show'])->name('sanpham.chitiet');

Route::get('/ma-giam-gia', [KhuyenMaiController::class, 'index'])->name('khuyenmai.index');
Route::post('/ajax/luu-voucher', [KhuyenMaiController::class, 'luuMa'])->name('voucher.save');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


Route::middleware('auth')->group(function () {
    Route::post('/danh-gia', [DanhGiaController::class, 'store'])->name('danhgia.store');

    Route::get('/yeu-thich', [YeuThichController::class, 'index'])->name('yeuthich.index');
    Route::delete('/yeu-thich/{id}', [YeuThichController::class, 'destroy'])->name('yeuthich.delete');
    // web.php
Route::get('/yeu-thich/them/{maSanPham}',
    [YeuThichController::class, 'store']
)->middleware('auth')
 ->name('yeuthich.store');


    Route::get('/gio-hang', [GioHangController::class, 'index'])->name('gio-hang');
    Route::delete('gio-hang/clear', [GioHangController::class, 'clear'])->name('gio-hang.clear');
    Route::post('/gio-hang/update/{maBienThe}', [GioHangController::class, 'update'])->name('gio-hang.update');
    Route::delete('/gio-hang/remove/{maBienThe}', [GioHangController::class, 'remove'])->name('gio-hang.remove');
    Route::post('/gio-hang/voucher', [GioHangController::class, 'applyVoucher'])->name('gio-hang.apply-voucher');
    Route::delete('/gio-hang/voucher', [GioHangController::class, 'removeVoucher'])->name('gio-hang.remove-voucher');
    Route::post('/ajax/gio-hang/add/{maBienThe}', [GioHangController::class, 'addAjax'])->name('giohang.add.ajax');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');

    Route::get('/tai-khoan', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/tai-khoan', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::get('/don-hang', [DonHangController::class, 'index'])->name('donhang.index');
    Route::get('/don-hang/{id}', [DonHangController::class, 'show'])->name('donhang.show');
    Route::post('/don-hang/{id}/huy', [DonHangController::class, 'cancel'])->name('donhang.cancel');
});


Route::get('/admin/orders', fn () => view('admin.orders'))->name('admin.orders');
Route::get('/admin/comments', fn () => view('admin.comments'))->name('admin.comments');
Route::get('/admin/categories', fn () => view('admin.categories'))->name('admin.categories');

Route::prefix('admin')->name('admin.')->group(function () {
    

    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::get('/products', [SanPhamAdminController::class, 'index'])->name('products.index');
    Route::get('/products/create', [SanPhamAdminController::class, 'create'])->name('products.create');
    Route::post('/products/store', [SanPhamAdminController::class, 'store'])->name('products.store');
    
});

Route::get('/admin/revenue', [AdminController::class, 'revenue'])->name('admin.revenue');



Route::delete(
    '/admin/products/{id}',
    [SanPhamAdminController::class, 'destroy']
)->name('admin.products.destroy');


Route::get(
    '/admin/comments',
    [\App\Http\Controllers\Admin\CommentAdminController::class, 'index']
)->name('admin.comments');

Route::delete(
    '/admin/comments/{id}',
    [\App\Http\Controllers\Admin\CommentAdminController::class, 'destroy']
)->name('admin.comments.destroy');



use App\Http\Controllers\Admin\DonHangAdminController;

Route::prefix('admin')->group(function () {


    Route::get('/orders', [DonHangAdminController::class, 'index'])
        ->name('admin.orders.index');


    Route::delete('/orders/{id}', [DonHangAdminController::class, 'destroy'])
        ->name('admin.orders.destroy');

    Route::patch('/orders/{id}/status', [DonHangAdminController::class, 'updateStatus'])
        ->name('admin.orders.updateStatus');
});

