<?php

namespace App\Providers;

use App\Models\DanhMuc;
use App\Models\ChiTietGioHang;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {

            // ===== DANH MỤC =====
            $danhMucs = DanhMuc::whereNull('DanhMucCha')->get();

            // ===== GIỎ HÀNG (TEST CỨNG) =====
            $TEST_GIO_HANG_ID = 1;

            $cartCount = ChiTietGioHang::where('MaGioHang', $TEST_GIO_HANG_ID)
            ->count();


            // ===== SHARE VIEW =====
            $view->with([
                'danhMucs'  => $danhMucs,
                'cartCount' => $cartCount,
            ]);
        });
    }
}
