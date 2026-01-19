<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DanhGia;

class CommentAdminController extends Controller
{
     public function index()
    {
        $comments = DanhGia::with(['sanPham', 'nguoiDung'])
            ->orderByDesc('MaDanhGia')
            ->paginate(10);

        return view('admin.comments', compact('comments'));
    }


    public function destroy($id)
        {
            DanhGia::where('MaDanhGia', $id)->delete();
            return back()->with('success', 'Đã xóa bình luận');
        }
}
