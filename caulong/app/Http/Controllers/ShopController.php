<?php

namespace App\Http\Controllers;

use App\Models\BienTheSanPham;
use App\Models\ThuongHieu;
use App\Models\SanPham;
use App\Models\HinhAnhSanPham;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
{
    $thuongHieus = ThuongHieu::all();

    $query = SanPham::with([
        'thuongHieu',
        'bienThes',
        'hinhAnhChinh'
    ])->where('TrangThai', 1);

    
    if ($request->filled('thuong_hieu') && $request->thuong_hieu !== 'all') {
        $query->where('MaThuongHieu', $request->thuong_hieu);
    }

    
    if ($request->filled('gia') && $request->gia !== 'all') {
        $query->whereHas('bienThes', function ($q) use ($request) {
            match ($request->gia) {
                '0-500' => $q->where('GiaBan', '<', 500000),
                '500-1000' => $q->whereBetween('GiaBan', [500000, 1000000]),
                '1000-2000' => $q->whereBetween('GiaBan', [1000000, 2000000]),
                '2000' => $q->where('GiaBan', '>', 2000000),
            };
        });
    }

    $sanPhams = $query->paginate(9);

    return view('shop.index', compact(
        'sanPhams',
        'thuongHieus'
    ));
}

}

