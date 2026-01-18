<?php

namespace App\Http\Controllers;

use App\Models\YeuThich;
use Illuminate\Support\Facades\Auth;

class YeuThichController extends Controller
{
    // Danh sách sản phẩm yêu thích
    public function index()
    {
        $wishlists = YeuThich::with('sanPham')
            ->where('MaNguoiDung', Auth::id())
            ->orderByDesc('NgayThem')
            ->get();

        return view('yeuthich.index', compact('wishlists'));
    }

    // Xoá khỏi yêu thích
    public function destroy($id)
    {
        YeuThich::where('MaYeuThich', $id)
            ->where('MaNguoiDung', Auth::id())
            ->delete();

        return redirect()
            ->route('yeuthich.index')
            ->with('success', 'Đã xoá khỏi danh sách yêu thích');
    }
}
