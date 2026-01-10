<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\ThuongHieu;
use App\Models\DanhMuc;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm, có filter theo danh mục, thương hiệu, giá
     * @param string|null $slug
     */
    public function index(Request $request, $slug = null)
    {
        $thuongHieus = ThuongHieu::all();
        $danhMucs = DanhMuc::all();

        // Nếu slug tồn tại, tìm danh mục hiện tại
        $danhMuc = null;
        if ($slug) {
            $danhMuc = DanhMuc::where('Slug', $slug)->firstOrFail();
        }

        $sanPhams = SanPham::with([
                'thuongHieu',
                'danhMuc',
                'bienThes',
                'hinhAnhChinh'
            ])
            ->where('TrangThai', 1)

            // Lọc theo danh mục: ưu tiên slug > query string
            ->when($danhMuc, fn($q) => $q->where('MaDanhMuc', $danhMuc->MaDanhMuc))
            ->when(!$danhMuc && $request->filled('danh_muc') && $request->danh_muc !== 'all',
                fn($q) => $q->where('MaDanhMuc', $request->danh_muc)
            )

            // Lọc theo thương hiệu
            ->when($request->filled('thuong_hieu') && $request->thuong_hieu !== 'all',
                fn($q) => $q->where('MaThuongHieu', $request->thuong_hieu)
            )

            // Lọc theo khoảng giá
            ->when($request->filled('gia') && $request->gia !== 'all', function ($q) use ($request) {
                $q->whereHas('bienThes', function ($bt) use ($request) {
                    match ($request->gia) {
                        '0-500' => $bt->where('GiaBan', '<', 500000),
                        '500-1000' => $bt->whereBetween('GiaBan', [500000, 1000000]),
                        '1000-2000' => $bt->whereBetween('GiaBan', [1000000, 2000000]),
                        '2000' => $bt->where('GiaBan', '>', 2000000),
                        default => null,
                    };
                });
            })

            ->paginate(6)
            ->withQueryString();

        return view('shop.index', compact(
            'sanPhams',
            'thuongHieus',
            'danhMucs',
            'danhMuc' // để view biết đang xem danh mục nào
        ));
    }
}
