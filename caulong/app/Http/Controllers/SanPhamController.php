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

    $sanPhamLienQuan = SanPham::where('MaDanhMuc', $sanPham->MaDanhMuc)
            ->where('MaSanPham', '!=', $sanPham->MaSanPham) 
            ->where('TrangThai', 1) 
            ->with(['hinhAnhChinh', 'bienThes']) 
            ->inRandomOrder() 
            ->limit(4)       
            ->get();

    return view('sanpham.chitiet', compact('sanPham', 'sanPhamLienQuan'));
}
}
