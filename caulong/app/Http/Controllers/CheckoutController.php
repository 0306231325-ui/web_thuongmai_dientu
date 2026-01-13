<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ChiTietGioHang;
use App\Models\BienTheSanPham;
use App\Models\PhuongThucThanhToan;
use App\Models\DonHang;
use App\Models\ChiTietDonHang;


class CheckoutController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $gioHang = \App\Models\GioHang::where('MaNguoiDung', $user->MaNguoiDung)->first();

    if (!$gioHang) {
        return redirect()->route('shop.index')->with('error', 'Giỏ hàng trống!');
    }
    $cartItems = ChiTietGioHang::with(['bienTheSanPham.sanPham'])
                ->where('MaGioHang', $gioHang->MaGioHang) 
                ->get();

    
    if ($cartItems->isEmpty()) {
        return redirect()->route('shop.index')->with('error', 'Giỏ hàng trống!');
    }

    
    $total = $cartItems->sum(function($item) {
        return $item->SoLuong * $item->bienTheSanPham->GiaBan;
    });

    
    $addresses = $user->diaChi; 
    $paymentMethods = PhuongThucThanhToan::where('TrangThai', 1)->get();

    return view('checkout.index', compact('cartItems', 'total', 'addresses', 'paymentMethods'));
}

public function process(Request $request)
{
    $user = Auth::user();

    $request->validate([
        'TenNguoiNhan' => 'required|string|max:100',
        'SoDienThoai' => 'required|string|max:20',
        'DiaChiGiaoHang' => 'required|string',
        'MaPhuongThucTT' => 'required|exists:PhuongThucThanhToan,MaPhuongThuc',
    ]);

    $gioHang = \App\Models\GioHang::where('MaNguoiDung', $user->MaNguoiDung)->first();

    if (!$gioHang) {
        return redirect()->back()->with('error', 'Giỏ hàng trống hoặc lỗi dữ liệu!');
    }

    $cartItems = ChiTietGioHang::where('MaGioHang', $gioHang->MaGioHang)->get();
    
    if($cartItems->isEmpty()) {
        return redirect()->back()->with('error', 'Giỏ hàng đã thay đổi, vui lòng kiểm tra lại');
    }

    $totalAmount = 0;

    DB::beginTransaction();
    try {

        $donHang = new DonHang();
        $donHang->MaNguoiDung = $user->MaNguoiDung;
        $donHang->TenNguoiNhan = $request->TenNguoiNhan;
        $donHang->SoDienThoaiNguoiNhan = $request->SoDienThoai;
        $donHang->DiaChiGiaoHang = $request->DiaChiGiaoHang;
        $donHang->GhiChu = $request->GhiChu;
        $donHang->NgayDat = now();
        $donHang->PhiShip = 0; 
        $donHang->GiamGia = 0;
        $donHang->MaPhuongThucTT = $request->MaPhuongThucTT;
        $donHang->TrangThaiDonHang = 'ChoXuLy';
        $donHang->TrangThaiThanhToan = 0; 
        
        foreach($cartItems as $item) {
            $totalAmount += $item->SoLuong * $item->bienTheSanPham->GiaBan;
        }
        $donHang->TienHang = $totalAmount;
        $donHang->TongTien = $totalAmount; 
        
        $donHang->save(); 

        foreach($cartItems as $item) {
            $variant = BienTheSanPham::find($item->MaBienThe);
            
            if ($variant->SoLuongTon < $item->SoLuong) {
                DB::rollBack();
                return redirect()->back()->with('error', "Sản phẩm {$variant->TenBienThe} không đủ hàng!");
            }

            ChiTietDonHang::create([
                'MaDonHang' => $donHang->MaDonHang,
                'MaBienThe' => $item->MaBienThe,
                'SoLuong'   => $item->SoLuong,
                'DonGia'    => $variant->GiaBan,
                'ThanhTien' => $item->SoLuong * $variant->GiaBan
            ]);

            $variant->decrement('SoLuongTon', $item->SoLuong);
        }

        ChiTietGioHang::where('MaGioHang', $gioHang->MaGioHang)->delete();


        DB::commit();

        return redirect()->route('checkout.success', $donHang->MaDonHang)
                         ->with('success', 'Đặt hàng thành công!');

    } catch (\Exception $e) {
        DB::rollBack();

        return redirect()->back()->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
    }
}

public function success($id)
    {

        $donHang = DonHang::with(['chiTiet.bienTheSanPham.sanPham'])
                    ->where('MaNguoiDung', Auth::id()) 
                    ->findOrFail($id);

        return view('checkout.success', compact('donHang'));
    }
}
