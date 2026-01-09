<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\BienTheSanPham;

class BienTheController extends Controller
{
    public function show($id)
    {
        $bienThe = BienTheSanPham::find($id);

        if (!$bienThe) {
            return response()->json([
                'message' => 'Không tìm thấy biến thể'
            ], 404);
        }

        return response()->json([
            'GiaBan' => $bienThe->GiaBan,
            'SoLuongTon' => $bienThe->SoLuongTon
        ]);
    }
}
