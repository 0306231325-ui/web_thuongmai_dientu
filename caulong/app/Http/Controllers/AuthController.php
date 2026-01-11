<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NguoiDung;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $roleIds = $user->vaiTros->pluck('MaVaiTro')->toArray();

            // Kiểm tra theo ID
            if (in_array(1, $roleIds)) { // 1 → QuanTriVien
                return redirect()->route('admin.dashboard');
            }

            if (in_array(3, $roleIds)) { // 3 → KhachHang
                return redirect('/'); // khách hàng → trang chính
            }

            abort(404); // nếu role khác
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|string',
            'MatKhau' => 'required|string',
        ]);

        $user = NguoiDung::where('TenDangNhap', $request->TenDangNhap)
                          ->where('TrangThai', 1)
                          ->first();

        if ($user && $user->MatKhau === $request->MatKhau) { // so sánh trực tiếp
            Auth::login($user);

            $roleIds = $user->vaiTros->pluck('MaVaiTro')->toArray();

            if (in_array(1, $roleIds)) { // 1 → QuanTriVien
                return redirect()->route('admin.dashboard');
            }

            if (in_array(3, $roleIds)) { // 3 → KhachHang
                return redirect('/'); // khách hàng → trang chính
            }

            Auth::logout();
            return abort(403, 'Bạn không có quyền truy cập');
        }

        return back()->withErrors([
            'login' => 'Sai tài khoản hoặc mật khẩu'
        ]);
    }
    public function showRegister()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'TenDangNhap' => 'required|string|unique:NguoiDung,TenDangNhap',
            'MatKhau' => 'required|string|confirmed|min:6',
            'HoTen' => 'required|string|max:255',
            'Email' => 'required|email|unique:NguoiDung,Email',
            'SoDienThoai' => 'nullable|string|max:15',
        ]);

        $user = new NguoiDung();
        $user->TenDangNhap = $request->TenDangNhap;
        $user->MatKhau = $request->MatKhau; // Nếu muốn hash: Hash::make($request->MatKhau)
        $user->HoTen = $request->HoTen;
        $user->Email = $request->Email;
        $user->SoDienThoai = $request->SoDienThoai;
        $user->TrangThai = 1; // kích hoạt tài khoản
        $user->save();

        // Gán vai trò Khách Hàng (MaVaiTro = 3)
        $user->vaiTros()->attach(3);

        Auth::login($user);

        return redirect('/');
    }
    public function logout()
    {
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/');
    }
}
