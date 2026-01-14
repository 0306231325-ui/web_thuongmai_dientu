<?php

namespace App\Http\Controllers;

use App\Models\GioHang;
use App\Models\ChiTietGioHang;
use App\Models\BienTheSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GioHangController extends Controller
{
    private function getGioHang()
    {
        return GioHang::firstOrCreate([
            'MaNguoiDung' => Auth::id()
        ]);
    }

    public function index()
    {
        $gioHang = $this->getGioHang();

        // Dữ liệu hiển thị (có phân trang)
        $items = ChiTietGioHang::with('bienTheSanPham.sanPham')
            ->where('MaGioHang', $gioHang->MaGioHang)
            ->paginate(3);

        // Dữ liệu tính tổng (không phân trang)
        $allItems = ChiTietGioHang::with('bienTheSanPham')
            ->where('MaGioHang', $gioHang->MaGioHang)
            ->get();

        $total = $allItems->sum(fn ($item) =>
            $item->SoLuong * ($item->bienTheSanPham->GiaBan ?? 0)
        );

        return view('giohang.index', compact('items', 'total'));
    }

    public function add(Request $request, $maBienThe)
    {
        $soLuong = max(1, (int) $request->input('soLuong', 1));
        $gioHang = $this->getGioHang();

        $item = ChiTietGioHang::firstOrNew([
            'MaGioHang' => $gioHang->MaGioHang,
            'MaBienThe' => $maBienThe
        ]);

        $item->SoLuong = ($item->SoLuong ?? 0) + $soLuong;
        $item->save();

        return back()->with('success', 'Đã thêm vào giỏ hàng');
    }

    public function remove($maBienThe)
    {
        $gioHang = $this->getGioHang();

        ChiTietGioHang::where('MaGioHang', $gioHang->MaGioHang)
            ->where('MaBienThe', $maBienThe)
            ->delete();

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

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

    public function addAjax(Request $request, $maBienThe)
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
}
