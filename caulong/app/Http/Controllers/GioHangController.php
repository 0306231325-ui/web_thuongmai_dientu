<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\KhuyenMai;
use App\Models\BienTheSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class GioHangController extends Controller
{
    private function getGioHang()
    {
        return GioHang::firstOrCreate([
            'MaNguoiDung' => Auth::id()
        ]);
    }

<<<<<<< Updated upstream
=======
    
>>>>>>> Stashed changes
    public function index()
    {
        $gioHang = $this->getGioHang();


        $items = ChiTietGioHang::with('bienTheSanPham.sanPham')
            ->where('MaGioHang', $gioHang->MaGioHang)
            ->paginate(3);


        $allItems = ChiTietGioHang::with('bienTheSanPham')
            ->where('MaGioHang', $gioHang->MaGioHang)
            ->get();

        $total = $allItems->sum(fn ($item) =>
            $item->SoLuong * ($item->bienTheSanPham->GiaBan ?? 0)
        );


<<<<<<< Updated upstream
        $myVouchers = collect([]); 
        
        if (Auth::check()) {
            /** @var \App\Models\NguoiDung $user */
            $user = Auth::user();
=======
    
    public function add(Request $request, $maBienThe)
    {
        $soLuong = $request->input('soLuong', 1);
>>>>>>> Stashed changes

            $myVouchers = $user->khuyenMais()
                ->where('TrangThai', 1)
                ->where('NgayKetThuc', '>=', Carbon::now())
                ->wherePivot('DaSuDung', 0)
                ->get();
        }

        return view('giohang.index', compact('items', 'total', 'myVouchers'));
    }

    public function remove($maBienThe)
    {
        $gioHang = $this->getGioHang();

        ChiTietGioHang::where('MaGioHang', $gioHang->MaGioHang)
            ->where('MaBienThe', $maBienThe)
            ->delete();

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

<<<<<<< Updated upstream
=======
    
>>>>>>> Stashed changes
    public function update(Request $request, $maBienThe)
    {
        $gioHang = $this->getGioHang();
        $soLuongMoi = max(1, (int) $request->soLuong);

        $bienThe = BienTheSanPham::find($maBienThe);

        if ($bienThe && $soLuongMoi > $bienThe->SoLuongTon) {
            return back()->with(
                'error',
                "Kho chỉ còn {$bienThe->SoLuongTon} sản phẩm, không đủ số lượng bạn yêu cầu."
            );
        }

        ChiTietGioHang::where('MaGioHang', $gioHang->MaGioHang)
            ->where('MaBienThe', $maBienThe)
            ->update(['SoLuong' => $soLuongMoi]);

        return back()->with('success', 'Đã cập nhật số lượng');
    }

<<<<<<< Updated upstream
    public function addAjax(Request $request, $maBienThe)
=======
    
    public function remove($maBienThe)
>>>>>>> Stashed changes
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập'
            ], 401);
        }

        $soLuongThem = (int) $request->soLuong;

        if ($soLuongThem <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Số lượng không hợp lệ'
            ], 400);
        }

        $bienThe = BienTheSanPham::find($maBienThe);

        if (!$bienThe) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tồn tại'
            ], 404);
        }

        $gioHang = $this->getGioHang();

        $item = ChiTietGioHang::where('MaGioHang', $gioHang->MaGioHang)
            ->where('MaBienThe', $maBienThe)
            ->first();

        $soLuongTrongGio = $item ? $item->SoLuong : 0;
        $tongSoLuongDuKien = $soLuongTrongGio + $soLuongThem;

        if ($tongSoLuongDuKien > $bienThe->SoLuongTon) {
            return response()->json([
                'success' => false,
                'message' =>
                    "Kho chỉ còn {$bienThe->SoLuongTon} sản phẩm (Giỏ đã có {$soLuongTrongGio})"
            ], 400);
        }

        if ($item) {
            $item->update(['SoLuong' => $tongSoLuongDuKien]);
        } else {
            ChiTietGioHang::create([
                'MaGioHang' => $gioHang->MaGioHang,
                'MaBienThe' => $maBienThe,
                'SoLuong' => $soLuongThem
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm vào giỏ hàng'
        ]);
    }

    public function clear()
    {
        $gioHang = $this->getGioHang();

        if ($gioHang) {
            $gioHang->chiTiet()->delete();
        }

        return redirect()
            ->route('gio-hang')
            ->with('success', 'Đã xóa tất cả sản phẩm trong giỏ hàng.');
    }

    public function applyVoucher(Request $request)
    {
        $code = $request->input('coupon_code');
        
        $voucher = KhuyenMai::where('MaCode', $code)->first();

        if (!$voucher) {
            return back()->with('error_coupon', 'Mã giảm giá không tồn tại.');
        }

        if ($voucher->TrangThai == 0 || 
            Carbon::now()->lt($voucher->NgayBatDau) || 
            Carbon::now()->gt($voucher->NgayKetThuc)) {
            return back()->with('error_coupon', 'Mã giảm giá đã hết hạn.');
        }

        if ($voucher->SoLuongSuDung >= $voucher->SoLuongToiDa) {
            return back()->with('error_coupon', 'Mã giảm giá đã hết lượt sử dụng.');
        }


        $gioHang = $this->getGioHang();
        $cartItems = ChiTietGioHang::with('bienTheSanPham')
            ->where('MaGioHang', $gioHang->MaGioHang)->get();
            
        $subTotal = $cartItems->sum(fn ($item) => $item->SoLuong * $item->bienTheSanPham->GiaBan);

        if ($subTotal < $voucher->DonHangToiThieu) {
            return back()->with('error_coupon', 
                'Đơn hàng tối thiểu để dùng mã này là ' . number_format($voucher->DonHangToiThieu) . '₫');
        }


        $discountAmount = 0;
        if ($voucher->PhanTramGiam > 0) {
            $discountAmount = $subTotal * ($voucher->PhanTramGiam / 100);

            if ($voucher->GiaTriGiamToiDa > 0) {
                $discountAmount = min($discountAmount, $voucher->GiaTriGiamToiDa);
            }
        } else {

            $discountAmount = $voucher->GiaTriGiamToiDa; 
        }


        session()->put('coupon', [
            'code' => $voucher->MaCode,
            'discount' => $discountAmount,
            'id' => $voucher->MaKhuyenMai
        ]);

        return back()->with('success', 'Áp dụng mã giảm giá thành công!');
    }

    public function removeVoucher()
    {
        session()->forget('coupon');
        return back()->with('success', 'Đã gỡ bỏ mã giảm giá.');
    }
}
