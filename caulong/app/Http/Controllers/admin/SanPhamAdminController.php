<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use App\Models\BienTheSanPham;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SanPhamAdminController extends Controller
{
    /**
     * DANH SÁCH SẢN PHẨM
     */
   public function index(Request $request)
    {
        $query = SanPham::with(['bienThes' => function ($q) {
            $q->orderBy('MaBienThe', 'asc');
        }]);

        if ($request->filled('keyword')) {
            $query->where('TenSanPham', 'like', '%' . $request->keyword . '%');
        }

        $sanPhams = $query
            ->orderByDesc('MaSanPham')
            ->paginate(10)
            ->withQueryString(); 

        return view('admin.products', compact('sanPhams'));
    }

    /**
     * FORM THÊM SẢN PHẨM
     */
    public function create()
    {
        $danhMucs = DanhMuc::all();
        $thuongHieus = ThuongHieu::all();

        return view('admin.products.create', compact('danhMucs', 'thuongHieus'));
    }

    /**
     * XỬ LÝ THÊM SẢN PHẨM
     */
    public function store(Request $request)
    {
        $request->validate([
            'TenSanPham'   => 'required|string|max:200',
            'MaDanhMuc'    => 'required|integer',
            'MaThuongHieu' => 'required|integer',
            'GiaBan'       => 'required|numeric|min:0',
            'SoLuongTon'   => 'required|integer|min:0',
            'HinhAnh'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        DB::beginTransaction();

        try {
            /**
             * 1️⃣ TẠO SLUG
             */
            $slug = Str::slug($request->TenSanPham);
            $count = SanPham::where('Slug', 'like', $slug . '%')->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            /**
             * 2️⃣ UPLOAD ẢNH (1 ảnh)
             * public/img/hinhanhsanpham
             */
            $duongDanAnh = null;
            if ($request->hasFile('HinhAnh')) {
                $file = $request->file('HinhAnh');
                $tenFile = time() . '_' . $file->getClientOriginalName();

                $file->move(
                    public_path('img/hinhanhsanpham'),
                    $tenFile
                );

                $duongDanAnh = 'img/hinhanhsanpham/' . $tenFile;
            }

            /**
             * 3️⃣ TẠO SẢN PHẨM
             */
            $sanPham = SanPham::create([
                'TenSanPham'   => $request->TenSanPham,
                'Slug'         => $slug,
                'HinhAnh'      => $duongDanAnh,
                'MoTaChiTiet'  => $request->MoTaChiTiet,
                'MaDanhMuc'    => $request->MaDanhMuc,
                'MaThuongHieu' => $request->MaThuongHieu,
                'LuotXem'      => 0,
            ]);

           
                 BienTheSanPham::create([
                'MaSanPham'  => $sanPham->MaSanPham,
                'SKU'        => 'SP' . $sanPham->MaSanPham . '-' . time(),
                'TenBienThe' => $request->TenBienThe ?? 'Phiên bản 1',
                'GiaBan'     => $request->GiaBan,
                'SoLuongTon' => $request->SoLuongTon,
            ]);


            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Thêm sản phẩm thành công');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function destroy($id)
{
    DB::beginTransaction();

    try {
        // Lấy sản phẩm
        $sanPham = SanPham::findOrFail($id);

        // Xóa biến thể trước (tránh lỗi FK)
        BienTheSanPham::where('MaSanPham', $id)->delete();

        // Xóa sản phẩm
        $sanPham->delete();

        DB::commit();

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Đã xóa sản phẩm thành công');

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->withErrors([
            'error' => 'Xóa thất bại: ' . $e->getMessage()
        ]);
    }
}

}
