@extends('layouts.app')

@section('content')
<div class="container" style="max-width:400px; margin-top:50px">

    <h3 class="mb-4">Đăng nhập</h3>

    @if ($errors->any())
        <div style="color:red; margin-bottom:15px">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group mb-3">
            <label>Tên đăng nhập</label>
            <input
                type="text"
                name="TenDangNhap"
                class="form-control"
                value="{{ old('TenDangNhap') }}"
                required
            >
        </div>
        <div class="form-group mb-3">
            <label>Mật khẩu</label>
            <input
                type="password"
                name="MatKhau"
                class="form-control"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary btn-block">
            Đăng nhập
        </button>   
</div>
    </form>

</div>
@endsection
