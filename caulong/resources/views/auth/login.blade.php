{{-- @extends('layouts.app')

@section('content')
<div class="modal fade" id="loginModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Đăng nhập</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tên đăng nhập</label>
                        <input
                            type="text"
                            name="TenDangNhap"
                            class="form-control"
                            value="{{ old('TenDangNhap') }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mật khẩu</label>
                        <input
                            type="password"
                            name="MatKhau"
                            class="form-control"
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-warning w-100">
                        Đăng nhập
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>
@endsection --}}
