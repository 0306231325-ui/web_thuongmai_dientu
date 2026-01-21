<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Carbon\Carbon; 

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function store(Request $request)
    {

        $request->validate([
            'ho_ten'   => 'required|min:3',
            'email'    => 'required|email',
            'tieu_de'  => 'required',
            'noi_dung' => 'required|min:10',
        ], [
            'ho_ten.required'   => 'Vui lòng nhập họ tên.',
            'email.email'       => 'Email không hợp lệ.',
            'noi_dung.required' => 'Nội dung không được để trống.',
            'noi_dung.min'      => 'Nội dung quá ngắn, vui lòng nhập thêm.',
        ]);

        DB::table('LienHe')->insert([
            'HoTen'       => $request->ho_ten,
            'Email'       => $request->email,
            'SoDienThoai' => $request->sdt,
            'TieuDe'      => $request->tieu_de,
            'NoiDung'     => $request->noi_dung,
            'NgayGui'     => Carbon::now(),
            'TrangThai'   => 0 
        ]);

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất.');
    }
}