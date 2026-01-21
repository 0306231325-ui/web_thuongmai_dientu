@extends('layouts.app')

@section('content')
<div class="container" style="max-width:600px; margin-top:50px">

    <div class="text-center mb-4">
        <h3 class="mb-3">Hồ sơ cá nhân</h3>
        
        @php
            $avatarPath = auth()->user()->AnhDaiDien 
                ? asset('img/avatars/' . auth()->user()->AnhDaiDien) 
                : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->HoTen);
        @endphp
        
        <img src="{{ $avatarPath }}" 
             alt="Avatar" 
             class="rounded-circle img-thumbnail" 
             style="width: 150px; height: 150px; object-fit: cover;">
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label>Mã Người Dùng</label>
            <input type="text" name="MaNguoiDung" class="form-control"
                   value="{{ auth()->user()->MaNguoiDung }}">
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Họ tên</label>
                    <input type="text" name="HoTen" class="form-control"
                           value="{{ auth()->user()->HoTen }}" required>
                </div>
            </div>
            <div class="col-md-6">
                 <div class="form-group mb-3">
                    <label class="font-weight-bold">Email</label>
                    <input type="email" name="Email" class="form-control"
                           value="{{ auth()->user()->Email }}" required>
                </div>
            </div>
        </div>

        <div class="form-group mb-3">
            <label class="font-weight-bold">Số điện thoại</label>
            <input type="text" name="SoDienThoai" class="form-control"
                   value="{{ auth()->user()->SoDienThoai }}">
        </div>
        <div class="form-group mb-3">
            <label>Tên đăng nhập</label>
            <input type="text" name="TenDangNhap" class="form-control"
                   value="{{ auth()->user()->TenDangNhap }}">
        </div>
        
        <div class="form-group mb-3">
            <label>Mật khẩu</label>
            <input type="text" name="MatKhau" class="form-control"
                   value="{{ auth()->user()->MatKhau }}">
        </div>

        <div class="form-group mb-3">
            <label class="font-weight-bold">Địa chỉ nhận hàng (Mặc định)</label>
            <input type="text" name="DiaChi" class="form-control"
                   placeholder="Nhập địa chỉ giao hàng..."
                   value="{{ auth()->user()->diaChi->where('MacDinh', 1)->first()->DiaChiChiTiet ?? (auth()->user()->diaChi->first()->DiaChiChiTiet ?? '') }}">
        </div>

        <div class="form-group mb-3">
            <label class="font-weight-bold">Đổi ảnh đại diện</label>
            <input type="file" name="AnhDaiDien" class="form-control-file">
        </div>

        <hr>

        <h5 class="mt-4">Đổi mật khẩu</h5>
        <div class="form-group mb-3">
            <label>Mật khẩu mới</label>
            <input type="password" name="MatKhau" class="form-control" placeholder="Bỏ trống nếu không muốn đổi">
        </div>

        <div class="form-group mb-4">
            <label>Nhập lại mật khẩu</label>
            <input type="password" name="MatKhau_confirmation" class="form-control">
        </div>

        <button class="btn btn-primary btn-block py-2">
            <i class="fa fa-save mr-2"></i> Lưu thay đổi
        </button>
    </form>
</div>
@endsection