<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use App\Models\BienTheSanPham;
use App\Models\DanhMuc;
use App\Models\ThuongHieu;
use App\Models\HinhAnhSanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SanPhamAdminController extends Controller
{

    public function index(Request $request)
    {
        $query = SanPham::with([
            'bienThes' => function ($q) {
                $q->orderBy('MaBienThe', 'asc');
            }
        ]);

        if ($request->filled('keyword')) {
            $query->where('TenSanPham', 'like', '%' . $request->keyword . '%');
        }

        $sanPhams = $query
            ->orderByDesc('MaSanPham')
            ->paginate(10)
            ->withQueryString();

        return view('admin.products', compact('sanPhams'));
    }

//Tao san pham
    public function create()
    {
        $danhMucs    = DanhMuc::all();
        $thuongHieus = ThuongHieu::all();

        return view('admin.products.create', compact(
            'danhMucs',
            'thuongHieus'
        ));
    }

//Them san pham
    public function store(Request $request)
    {
        $this->validateProduct($request);

        DB::beginTransaction();

        try {
            $slug  = Str::slug($request->TenSanPham);
            $count = SanPham::where('Slug', 'like', $slug . '%')->count();
            if ($count > 0) {
                $slug .= '-' . ($count + 1);
            }

            $sanPham = SanPham::create([
                'TenSanPham'   => $request->TenSanPham,
                'Slug'         => $slug,
                'MoTaChiTiet'  => $request->MoTaChiTiet,
                'MaDanhMuc'    => $request->MaDanhMuc,
                'MaThuongHieu' => $request->MaThuongHieu,
                'LuotXem'      => 0,
            ]);

            $this->uploadImage($request, $sanPham->MaSanPham);

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
            return back()->withErrors([
                'error' => 'Có lỗi xảy ra: ' . $e->getMessage()
            ])->withInput();
        }
    }

//chinh sua
    public function edit($id)
    {
        $sanPham     = SanPham::with(['bienThes', 'hinhAnhs'])->findOrFail($id);
        $danhMucs    = DanhMuc::all();
        $thuongHieus = ThuongHieu::all();

        return view('admin.products.edit', compact(
            'sanPham',
            'danhMucs',
            'thuongHieus'
        ));
    }

//cap nhat
    public function update(Request $request, $id)
    {
        $this->validateProduct($request);

        DB::beginTransaction();

        try {
            $sanPham = SanPham::findOrFail($id);


            $sanPham->update([
                'TenSanPham'   => $request->TenSanPham,
                'MoTaChiTiet'  => $request->MoTaChiTiet,
                'MaDanhMuc'    => $request->MaDanhMuc,
                'MaThuongHieu' => $request->MaThuongHieu,
            ]);

            BienTheSanPham::where('MaSanPham', $id)->first()?->update([
                'GiaBan'     => $request->GiaBan,
                'SoLuongTon' => $request->SoLuongTon,
            ]);

            if ($request->hasFile('HinhAnh')) {
                $this->deleteOldImage($id);
                $this->uploadImage($request, $id);
            }

            DB::commit();

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Cập nhật sản phẩm thành công');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors([
                'error' => 'Lỗi cập nhật: ' . $e->getMessage()
            ]);
        }
    }

//Xoa san pham
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $this->deleteOldImage($id);

            HinhAnhSanPham::where('MaSanPham', $id)->delete();
            BienTheSanPham::where('MaSanPham', $id)->delete();
            SanPham::findOrFail($id)->delete();

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


    private function validateProduct(Request $request)
    {
        $request->validate([
            'TenSanPham'   => 'required|string|max:200',
            'MaDanhMuc'    => 'required|integer',
            'MaThuongHieu' => 'required|integer',
            'GiaBan'       => 'required|numeric|min:0',
            'SoLuongTon'   => 'required|integer|min:0',
            'HinhAnh'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    }

    private function uploadImage(Request $request, $maSanPham)
    {
        if ($request->hasFile('HinhAnh')) {
            $file    = $request->file('HinhAnh');
            $tenFile = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('img/hinhanhsanpham'), $tenFile);

            HinhAnhSanPham::create([
                'MaSanPham'  => $maSanPham,
                'DuongDan'   => $tenFile,
                'LaAnhChinh' => 1,
            ]);
        }
    }

    private function deleteOldImage($maSanPham)
    {
        $anhCu = HinhAnhSanPham::where('MaSanPham', $maSanPham)
            ->where('LaAnhChinh', 1)
            ->first();

        if ($anhCu) {
            $path = public_path('img/hinhanhsanpham/' . $anhCu->DuongDan);
            if (file_exists($path)) unlink($path);
            $anhCu->delete();
        }
    }
}
