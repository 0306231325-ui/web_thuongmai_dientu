<?php

namespace App\Http\Controllers;

use App\Models\SanPham;

class SanPhamController extends Controller
{
    public function show($slug)
    {
         $sanPham = SanPham::with([
        'bienThes',
        'hinhAnhs',
        'hinhAnhChinh',
        'thuongHieu',
        'danhGias.nguoiDung'
    ])->where('Slug', $slug)->firstOrFail();

    return view('sanpham.chitiet', compact('sanPham'));
}
}
