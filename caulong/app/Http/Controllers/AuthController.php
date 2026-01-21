<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;
use App\Models\DiaChiNguoiDung;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            /** @var \App\Models\NguoiDung $user */
            $user = Auth::user();

            $roleIds = $user->vaiTros
                ? $user->vaiTros->pluck('MaVaiTro')->toArray()
                : [];

            if (in_array(1, $roleIds)) {
                return redirect()->route('admin.dashboard');
            }

            if (in_array(3, $roleIds)) {
                return redirect('/');
            }

            abort(404);
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|string',
            'MatKhau'     => 'required|string',
        ]);

        $user = NguoiDung::where('TenDangNhap', $request->TenDangNhap)
            ->where('TrangThai', 1)
            ->first();

        if (!$user || $user->MatKhau !== $request->MatKhau) {
            return back()->withErrors([
                'login' => 'Sai tài khoản hoặc mật khẩu'
            ]);
        }

        Auth::login($user);

        $roleIds = $user->vaiTros
            ? $user->vaiTros->pluck('MaVaiTro')->toArray()
            : [];

        // 🔴 QUẢN TRỊ VIÊN
        if (in_array(1, $roleIds)) {
            return redirect()
                ->route('admin.index')
                ->with('success', 'Đăng nhập quản trị viên thành công');
        }

        // 🟢 KHÁCH HÀNG
        if (in_array(3, $roleIds)) {
            return redirect('/')
                ->with('success', 'Đăng nhập thành công');
        }

        Auth::logout();
        abort(403, 'Bạn không có quyền truy cập');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|string|unique:NguoiDung,TenDangNhap',
            'MatKhau'     => 'required|string|confirmed|min:6',
            'HoTen'       => 'required|string|max:255',
            'Email'       => 'required|email|unique:NguoiDung,Email',
            'SoDienThoai' => 'nullable|string|max:15',
        ]);

        $user = new NguoiDung();
        $user->TenDangNhap = $request->TenDangNhap;
        $user->MatKhau     = $request->MatKhau;
        $user->HoTen       = $request->HoTen;
        $user->Email       = $request->Email;
        $user->SoDienThoai = $request->SoDienThoai;
        $user->TrangThai   = 1;
        $user->save();

        // gán vai trò Khách Hàng
        $user->vaiTros()->attach(3);

        Auth::login($user);

        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function showProfile()
    {
        return view('auth.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'HoTen'       => 'required',
            'Email'       => 'required|email',
            'SoDienThoai' => 'nullable',
            'DiaChi'      => 'nullable|string',
            'AnhDaiDien'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'MatKhau'     => 'nullable|min:6|confirmed',
        ], [
            'AnhDaiDien.image' => 'File tải lên phải là hình ảnh',
            'AnhDaiDien.max'   => 'Dung lượng ảnh không được quá 2MB',
            'MatKhau.min'      => 'Mật khẩu phải ít nhất 6 ký tự',
            'MatKhau.confirmed'=> 'Mật khẩu nhập lại không khớp',
        ]);

        /** @var \App\Models\NguoiDung $user */
        $user = Auth::user();

        $user->HoTen       = $request->HoTen;
        $user->Email       = $request->Email;
        $user->SoDienThoai = $request->SoDienThoai;

        if ($request->hasFile('AnhDaiDien')) {
            $file = $request->file('AnhDaiDien');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/avatars'), $filename);
            $user->AnhDaiDien = $filename;
        }

        if ($request->filled('MatKhau')) {
            $user->MatKhau = $request->MatKhau;
        }

        $user->save();

        if ($request->filled('DiaChi')) {
            $diaChi = DiaChiNguoiDung::where('MaNguoiDung', $user->MaNguoiDung)
                ->where('MacDinh', 1)
                ->first();

            if ($diaChi) {
                $diaChi->DiaChiChiTiet = $request->DiaChi;
                $diaChi->TenNguoiNhan  = $user->HoTen;
                $diaChi->SoDienThoai   = $user->SoDienThoai;
                $diaChi->save();
            } else {
                DiaChiNguoiDung::create([
                    'MaNguoiDung'     => $user->MaNguoiDung,
                    'TenNguoiNhan'    => $user->HoTen,
                    'SoDienThoai'     => $user->SoDienThoai,
                    'DiaChiChiTiet'   => $request->DiaChi,
                    'MacDinh'         => 1
                ]);
            }
        }

        return back()->with('success', 'Cập nhật hồ sơ thành công');
    }
}
