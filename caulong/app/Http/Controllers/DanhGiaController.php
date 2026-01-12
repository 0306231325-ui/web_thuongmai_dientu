<?php

namespace App\Http\Controllers;

use App\Models\DanhGia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DanhGiaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'MaSanPham' => 'required',
            'SoSao' => 'required|integer|min:1|max:5',
            'BinhLuan' => 'required|string|max:1000'
        ]);

        DanhGia::create([
            'MaSanPham'   => $request->MaSanPham,
            'MaNguoiDung' => Auth::user()->MaNguoiDung,
            'SoSao'       => $request->SoSao,
            'BinhLuan'    => $request->BinhLuan,
            'NgayDanhGia' => now(),
        ]);

        return back()->with('success', 'Đã gửi đánh giá thành công');
    }
}
