<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\Slideshow;

class HomeController extends Controller
{
    public function index()
    {
        
        $slides = Slideshow::where('HienThi', 1)
            ->orderBy('ThuTu')
            ->get();

        
        $products = SanPham::with([
                'danhGias',
                'hinhAnhChinh', 
                'bienThes' => function ($q) {
                    $q->orderBy('GiaBan', 'asc');
                }
            ])
            ->where('TrangThai', 1)
            ->orderByDesc('MaSanPham')
            ->limit(8)
            ->get();

        
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
