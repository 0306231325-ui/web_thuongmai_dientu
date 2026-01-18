{{-- ================= POPUP ĐĂNG NHẬP ================= --}}
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                @if ($errors->any())
                    <div class="alert alert-danger" id="autoCloseAlert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label>Tên đăng nhập</label>
                        <input type="text" name="TenDangNhap" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" name="MatKhau" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-warning btn-block">
                        Đăng nhập
                    </button>

                    <div class="text-center mt-3">
                        <a href="{{ url('/') }}">← Quay lại trang chủ</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
{{-- ================================================= --}}
=======
{{-- ================================================= --}}
>>>>>>> 2a1e3095e7c895fb0fd2933d278c5491321b1794
