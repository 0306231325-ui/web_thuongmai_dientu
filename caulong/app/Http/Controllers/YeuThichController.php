<?php

namespace App\Http\Controllers;

use App\Models\YeuThich;
use Illuminate\Support\Facades\Auth;

class YeuThichController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); 

        $wishlists = YeuThich::with('sanPham')
            ->where('MaNguoiDung', $userId)
            ->orderByDesc('NgayThem')
            ->get();

        return view('yeuthich.index', compact('wishlists'));
    }

    public function destroy($id)
    {
        YeuThich::where('MaYeuThich', $id)->delete();
        return back()->with('success', 'Đã xoá khỏi yêu thích');
    }
}
