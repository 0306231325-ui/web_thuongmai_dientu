@extends('layouts.app')

@section('content')
<div class="container" style="max-width:400px; margin-top:50px">

    <h3 class="mb-4">Thông tin tài khoản</h3>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf

        <div class="form-group mb-3">
            <label>Họ tên</label>
            <input type="text" name="HoTen" class="form-control"
                   value="{{ auth()->user()->HoTen }}">
        </div>

        <div class="form-group mb-3">
            <label>Email</label>
            <input type="email" name="Email" class="form-control"
                   value="{{ auth()->user()->Email }}">
        </div>

        <div class="form-group mb-3">
            <label>Số điện thoại</label>
            <input type="text" name="SoDienThoai" class="form-control"
                   value="{{ auth()->user()->SoDienThoai }}">
        </div>

        <hr>

        <div class="form-group mb-3">
            <label>Mật khẩu mới (nếu muốn đổi)</label>
            <input type="password" name="MatKhau" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label>Nhập lại mật khẩu</label>
            <input type="password" name="MatKhau_confirmation" class="form-control">
        </div>

        <button class="btn btn-primary btn-block">
            Cập nhật
        </button>
    </form>

</div>
@endsection
