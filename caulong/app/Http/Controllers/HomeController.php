<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\Slideshow;

class HomeController extends Controller
{
    public function index()
    {
        /**
         * 🔹 SLIDESHOW (BANNER)
         */
        $slides = Slideshow::where('HienThi', 1)
            ->orderBy('ThuTu')
            ->get();

        /**
         * 🔹 SẢN PHẨM MỚI NHẤT
         */
        $products = SanPham::with([
                'danhGias',
                'bienThes' => function ($q) {
                    $q->orderBy('GiaBan', 'asc');
                }
            ])
            ->where('TrangThai', 1)
            ->orderByDesc('MaSanPham')
            ->limit(8)
            ->get();

        /**
         * 🔹 DANH MỤC (LOGIC CŨ)
         * - Đếm số sản phẩm đang bán
         */
        $categories = DanhMuc::withCount([
            'sanPhams' => function ($q) {
                $q->where('TrangThai', 1);
            }
        ])->get();

        return view('home.index', compact(
            'slides',
            'products',
            'categories'
        ));
    }
}
