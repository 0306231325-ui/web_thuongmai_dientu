<?php

namespace App\Http\Controllers;

use App\Models\SanPham;

class SanPhamController extends Controller
{
    public function show($slug)
    {
         $sanPham = SanPham::with([
        'bienThes',
        'hinhAnhChinh',
        'thuongHieu',
        'danhGias.nguoiDung'
    ])->where('Slug', $slug)->firstOrFail();
    $sanPham->increment('LuotXem');

    return view('sanpham.chitiet', compact('sanPham'));
}
}
