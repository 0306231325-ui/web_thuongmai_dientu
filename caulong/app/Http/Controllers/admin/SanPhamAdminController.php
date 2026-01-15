<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

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

}
