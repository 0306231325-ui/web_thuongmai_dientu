<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DonHang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function revenue(Request $request)
    {
        $filter = $request->input('filter', 'thang');
        $now = Carbon::now();

        $queryAll = DonHang::query();
        $title = '';

        switch ($filter) {
            case 'ngay':
                $queryAll->whereDate('NgayDat', $now->toDateString());
                $title = 'Hôm nay (' . $now->format('d/m/Y') . ')';
                break;
            case 'tuan':
                $startOfWeek = $now->copy()->startOfWeek();
                $endOfWeek   = $now->copy()->endOfWeek();
                $queryAll->whereBetween('NgayDat', [$startOfWeek, $endOfWeek]);
                $title = 'Tuần này (' . $startOfWeek->format('d/m') . ' - ' . $endOfWeek->format('d/m') . ')';
                break;
            case 'quy':
                $startOfQuarter = $now->copy()->firstOfQuarter();
                $endOfQuarter   = $now->copy()->lastOfQuarter();
                $queryAll->whereBetween('NgayDat', [$startOfQuarter, $endOfQuarter]);
                $title = 'Quý ' . $now->quarter . ' / ' . $now->year;
                break;
            case 'nam':
                $queryAll->whereYear('NgayDat', $now->year);
                $title = 'Năm ' . $now->year;
                break;
            default:
                $queryAll->whereMonth('NgayDat', $now->month)->whereYear('NgayDat', $now->year);
                $title = 'Tháng ' . $now->month . '/' . $now->year;
                break;
        }

        $queryRevenue = $queryAll->clone();
        $queryRevenue->where(function($q) {
            $q->where(function($subQ) {
                $subQ->whereIn('MaPhuongThucTT', [2, 3, 4])->where('TrangThaiDonHang', '!=', 'DaHuy');
            })->orWhere(function($subQ) {

                $subQ->where('MaPhuongThucTT', 1)->where('TrangThaiDonHang', 'DaGiao');
            });
        });
        $tongDoanhThu = $queryRevenue->sum('TongTien');
        
        $donThanhCong = $queryAll->clone()->where('TrangThaiDonHang', 'DaGiao')->count();
        $donChoXuLy   = $queryAll->clone()->where('TrangThaiDonHang', 'ChoXuLy')->count();
        $donDangGiao  = $queryAll->clone()->where('TrangThaiDonHang', 'DangGiao')->count();
        $cntDonHuy    = $queryAll->clone()->where('TrangThaiDonHang', 'DaHuy')->count();
        
        $queryPending = $queryAll->clone()->whereIn('TrangThaiDonHang', ['ChoXuLy', 'DangGiao']);
        
        $chiTietCOD = $queryPending->clone()->where('MaPhuongThucTT', 1)->count();
        $tienCOD    = $queryPending->clone()->where('MaPhuongThucTT', 1)->sum('TongTien');

        $chiTietOnline = $queryPending->clone()->whereIn('MaPhuongThucTT', [2, 3, 4])->count();
        $tienOnline    = $queryPending->clone()->whereIn('MaPhuongThucTT', [2, 3, 4])->sum('TongTien');

        return view('admin.revenue', compact(
            'tongDoanhThu', 'donThanhCong', 'cntDonHuy',
            'donChoXuLy', 'donDangGiao',
            'chiTietCOD', 'tienCOD', 'chiTietOnline', 'tienOnline',
            'filter', 'title'
        ));
    }
}