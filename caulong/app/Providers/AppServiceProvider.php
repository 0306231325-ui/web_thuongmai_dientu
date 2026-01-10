<?php

namespace App\Providers;
use App\Models\DanhMuc;
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
        //
        View::composer('*', function ($view) {
        $danhMucs = DanhMuc::whereNull('DanhMucCha')->get();
        $view->with('danhMucs', $danhMucs);
    });
    }
}
