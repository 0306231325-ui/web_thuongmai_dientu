<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DanhMuc;

class DanhMucAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = DanhMuc::whereNull('DanhMucCha')
            ->with(['children']);

        // 🔍 TÌM KIẾM
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;

            $query->where('TenDanhMuc', 'like', "%$keyword%")
                  ->orWhereHas('children', function ($q) use ($keyword) {
                      $q->where('TenDanhMuc', 'like', "%$keyword%");
                  });
        }

        $categories = $query
            ->orderBy('MaDanhMuc', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'TenDanhMuc' => 'required|string|max:255',
            'DanhMucCha' => 'nullable|integer'
        ]);

        DanhMuc::create([
            'TenDanhMuc' => $request->TenDanhMuc,
            'DanhMucCha' => $request->DanhMucCha
        ]);

        return redirect()->back()->with('success', 'Đã thêm danh mục');
    }

    public function destroy($id)
    {
        $category = DanhMuc::findOrFail($id);

        DanhMuc::where('DanhMucCha', $category->MaDanhMuc)->delete();

        $category->delete();

        return redirect()->back()->with('success', 'Đã xóa danh mục');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'TenDanhMuc' => 'required|string|max:255',
            'DanhMucCha' => 'nullable|integer'
        ]);

        $category = DanhMuc::findOrFail($id);

        if ($request->DanhMucCha == $category->MaDanhMuc) {
            return redirect()->back()->with('error', 'Danh mục cha không hợp lệ');
        }

        $category->update([
            'TenDanhMuc' => $request->TenDanhMuc,
            'DanhMucCha' => $request->DanhMucCha
        ]);

        return redirect()->back()->with('success', 'Cập nhật danh mục thành công');
    }
}
