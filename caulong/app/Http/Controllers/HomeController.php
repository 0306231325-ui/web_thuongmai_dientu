<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use App\Models\DanhMuc;
use App\Models\Slideshow;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
       
        $slides = Slideshow::where('HienThi', 1)
            ->orderBy('ThuTu')
            ->get();

        $products = SanPham::with([
                'danhGias',
                'hinhAnhChinh', 
                'bienThes' => function ($q) {
                    $q->orderBy('GiaBan', 'asc');
                }
            ])
            ->where('TrangThai', 1)
            ->orderByDesc('MaSanPham')
            ->limit(8)
            ->get();

 
        foreach ($products as $sp) {
            
            $bienTheDau = $sp->bienThes->first();
            $sp->gia_hien_thi = $bienTheDau ? $bienTheDau->GiaBan : 0;
            $sp->ten_bien_the = $bienTheDau ? $bienTheDau->TenBienThe : '';

            if ($sp->hinhAnhChinh) {
                $sp->anh_hien_thi = asset('img/hinhanhsanpham/' . $sp->hinhAnhChinh->DuongDan);
            } else {
                $sp->anh_hien_thi = asset('img/no-image.png');
            }
            if ($sp->danhGias->count() > 0) {
                $sp->diem_trung_binh = round($sp->danhGias->avg('SoSao'), 1);
            } else {
                $sp->diem_trung_binh = 0;
            }
        }

        $categories = DanhMuc::withCount([
            'sanPhams' => function ($q) {
                $q->where('TrangThai', 1);
            }
        ])->get();

        return view('home.index', compact(
            'slides',
            'products',
            'categories'
        ));
    }
}