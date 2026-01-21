<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use Illuminate\Support\Facades\Auth;

class DonHangController extends Controller
{
    public function index()
    {
        $donHangs = DonHang::where('MaNguoiDung', Auth::id())
            ->orderByDesc('NgayDat')
            ->get();

        return view('donhang.index', compact('donHangs'));
    }

    public function show($id)
    {
        $donHang = DonHang::with('chiTiet.bienThe')
            ->where('MaDonHang', $id)
            ->where('MaNguoiDung', Auth::id())
            ->firstOrFail();

        return view('donhang.show', compact('donHang'));
    }

    public function cancel($id)
    {
        $donHang = DonHang::where('MaDonHang', $id)
            ->where('MaNguoiDung', Auth::id())
            ->firstOrFail();


        if ($donHang->TrangThaiDonHang !== 'ChoXuLy') {
            return redirect()->route('donhang.index')
                ->with('error', 'Chỉ có thể huỷ đơn khi đang chờ xử lý');
        }

        $donHang->TrangThaiDonHang = 'DaHuy';
        $donHang->save();

        return redirect()->route('donhang.index')
            ->with('success', 'Huỷ đơn hàng thành công');
    }
}