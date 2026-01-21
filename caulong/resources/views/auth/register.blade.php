@extends('layouts.app')

@section('content')
<div class="container" style="max-width:400px; margin-top:50px">

    <h3 class="mb-4">Đăng ký</h3>

    @if ($errors->any())
        <div style="color:red; margin-bottom:15px">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- TenDangNhap -->
        <div class="form-group mb-3">
            <label>Tên đăng nhập *</label>
            <input
                type="text"
                name="TenDangNhap"
                class="form-control"
                value="{{ old('TenDangNhap') }}"
                required
            >
        </div>

        <!-- MatKhau -->
        <div class="form-group mb-3">
            <label>Mật khẩu *</label>
            <input
                type="password"
                name="MatKhau"
                class="form-control"
                required
            >
        </div>

        <!-- Nhập lại MatKhau -->
        <div class="form-group mb-3">
            <label>Nhập lại mật khẩu *</label>
            <input
                type="password"
                name="MatKhau_confirmation"
                class="form-control"
                required
            >
        </div>

        <!-- HoTen -->
        <div class="form-group mb-3">
            <label>Họ tên *</label>
            <input
                type="text"
                name="HoTen"
                class="form-control"
                value="{{ old('HoTen') }}"
                required
            >
        </div>

        <!-- Email -->
        <div class="form-group mb-3">
            <label>Email *</label>
            <input
                type="email"
                name="Email"
                class="form-control"
                value="{{ old('Email') }}"
                required
            >
        </div>

        <!-- SoDienThoai -->
        <div class="form-group mb-3">
            <label>Số điện thoại</label>
            <input
                type="text"
                name="SoDienThoai"
                class="form-control"
                value="{{ old('SoDienThoai') }}"
            >
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Đăng ký
        </button>

    </form>

    <p class="mt-3 text-center">
    Bạn đã có tài khoản?
    <a href="{{ url('/?login=1') }}">Đăng nhập</a>
    </p>

    
</div>

</div>
@endsection
