<?php

namespace App\Providers;

use App\Models\DanhMuc;
use App\Models\ChiTietGioHang;
use App\Models\GioHang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {

            if (Schema::hasTable('DanhMuc')) {               
                $danhMucs = DanhMuc::whereNull('DanhMucCha')->get();
            } else {
                $danhMucs = collect();
            }

            $cartCount = 0;

            if (
                Auth::check() &&
                Schema::hasTable('GioHang') &&
                Schema::hasTable('ChiTietGioHang')
            ) {
                $gioHang = GioHang::where('MaNguoiDung', Auth::id())->first();

                if ($gioHang) {
                    $cartCount = ChiTietGioHang::where('MaGioHang', $gioHang->MaGioHang)
                        ->sum('SoLuong');
                }
            }

            $view->with(compact('danhMucs', 'cartCount'));
        });
    }
}
