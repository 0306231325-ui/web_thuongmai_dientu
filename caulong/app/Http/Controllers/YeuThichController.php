<?php

namespace App\Http\Controllers;

use App\Models\YeuThich;
use Illuminate\Support\Facades\Auth;

class YeuThichController extends Controller
{

    public function index()
    {
        $wishlists = YeuThich::with('sanPham')
            ->where('MaNguoiDung', Auth::id())
            ->orderByDesc('NgayThem')
            ->get();

        return view('yeuthich.index', compact('wishlists'));
    }


    public function destroy($id)
    {
        YeuThich::where('MaYeuThich', $id)
            ->where('MaNguoiDung', Auth::id())
            ->delete();

        return redirect()
            ->route('yeuthich.index')
            ->with('success', 'Đã xoá khỏi danh sách yêu thích');
    }

    public function store($maSanPham)
    {
        $userId = Auth::id();

        $daThich = YeuThich::where('MaNguoiDung', $userId)
            ->where('MaSanPham', $maSanPham)
            ->exists();

        if (!$daThich) {
            YeuThich::create([
                'MaNguoiDung' => $userId,
                'MaSanPham'   => $maSanPham,
                'NgayThem'    => now()
            ]);
        }

        return redirect()->back()
            ->with('success', 'Đã thêm vào yêu thích ');
    }
}