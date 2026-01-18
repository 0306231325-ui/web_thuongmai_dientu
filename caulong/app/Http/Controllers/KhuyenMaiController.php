<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhuyenMai;
use App\Models\NguoiDungKhuyenMai;
use Illuminate\Support\Facades\Auth;

class KhuyenMaiController extends Controller
{
    public function index()
    {
        $vouchers = KhuyenMai::where('TrangThai', 1)
            ->where('NgayKetThuc', '>=', now()) 
            ->whereColumn('SoLuongSuDung', '<', 'SoLuongToiDa') 
            ->orderBy('NgayKetThuc', 'asc')
            ->get();

        $myVouchers = [];
        if (Auth::check()) {
            $myVouchers = NguoiDungKhuyenMai::where('MaNguoiDung', Auth::id())
                ->pluck('MaKhuyenMai')
                ->toArray();
        }

        return view('khuyenmai.index', compact('vouchers', 'myVouchers'));
    }

    public function luuMa(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng đăng nhập!'], 401);
        }


        $user = Auth::user(); 
        $code = $request->input('code'); 
        $voucher = KhuyenMai::where('MaCode', $code)->first();

        if (!$voucher) {
            return response()->json(['status' => 'error', 'message' => 'Mã giảm giá không tồn tại']);
        }

        $check = NguoiDungKhuyenMai::where('MaNguoiDung', $user->MaNguoiDung) 
                    ->where('MaKhuyenMai', $voucher->MaKhuyenMai)
                    ->exists();

        if ($check) {
            return response()->json(['status' => 'warning', 'message' => 'Bạn đã lưu mã này rồi']);
        }
        NguoiDungKhuyenMai::create([
            'MaNguoiDung' => $user->MaNguoiDung,
            'MaKhuyenMai' => $voucher->MaKhuyenMai,
            'NgayLuu' => now(),
            'DaSuDung' => 0
        ]);

        return response()->json(['status' => 'success', 'message' => 'Lưu mã thành công!']);
    }
}