<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;

class SanPhamAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = SanPham::query();

        if ($request->filled('keyword')) {
            $query->where('TenSanPham', 'like', '%' . $request->keyword . '%');
        }

        $sanPhams = $query->orderByDesc('MaSanPham')->get();

        return view('admin.products', compact('sanPhams'));
    }


    public function create()
    {
        $danhMucs = DanhMuc::all();
        $thuongHieus = ThuongHieu::all();

        return view('admin.products.create', compact('danhMucs', 'thuongHieus'));
    }
   public function store(Request $request)
    {
        $request->validate([
            'TenSanPham' => 'required|string|max:200',
            'MaDanhMuc' => 'required|integer',
            'MaThuongHieu' => 'required|integer',
        ]);

        $slug = Str::slug($request->TenSanPham);

        $count = SanPham::where('Slug', 'like', $slug . '%')->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        SanPham::create([
            'TenSanPham' => $request->TenSanPham,
            'Slug' => $slug,
            'HinhAnh' => null,
            'MoTaChiTiet' => $request->MoTaChiTiet,
            'MaDanhMuc' => $request->MaDanhMuc,
            'MaThuongHieu' => $request->MaThuongHieu,
            'LuotXem' => 0
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Thêm sản phẩm thành công');
    }


}
