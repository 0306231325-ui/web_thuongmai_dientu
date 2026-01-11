<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use Illuminate\Http\Request;

class GioHangController extends Controller
{
    // TEST CỨNG GIỎ HÀNG
    private int $TEST_GIO_HANG_ID = 1;

    
    public function index()
    {
        $gioHang = GioHang::findOrFail($this->TEST_GIO_HANG_ID);

        $items = ChiTietGioHang::with('bienTheSanPham.sanPham')
            ->where('MaGioHang', $gioHang->MaGioHang)
            ->get();

        $total = $items->sum(function ($item) {
            return $item->SoLuong * ($item->bienTheSanPham->GiaBan ?? 0);
        });

        return view('giohang.index', compact('items', 'total'));
    }

    
    public function add(Request $request, $maBienThe)
    {
        $soLuong = $request->input('soLuong', 1);

        $gioHang = GioHang::findOrFail($this->TEST_GIO_HANG_ID);

        $item = ChiTietGioHang::firstOrNew([
            'MaGioHang' => $gioHang->MaGioHang,
            'MaBienThe' => $maBienThe
        ]);

        $item->SoLuong = ($item->SoLuong ?? 0) + $soLuong;
        $item->save();

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    
    public function update(Request $request, $maBienThe)
    {
        $soLuong = max(1, (int)$request->soLuong);

        ChiTietGioHang::where('MaGioHang', $this->TEST_GIO_HANG_ID)
            ->where('MaBienThe', $maBienThe)
            ->update(['SoLuong' => $soLuong]);

        return redirect()->back();
    }

    
    public function remove($maBienThe)
    {
        ChiTietGioHang::where('MaGioHang', $this->TEST_GIO_HANG_ID)
            ->where('MaBienThe', $maBienThe)
            ->delete();

        return redirect()->back();
    }
}
