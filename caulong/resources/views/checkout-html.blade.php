@extends('layouts.app')

@section('title', 'Thanh toán')

@section('content')
<div class="container mt-4 mb-5">

<div class="mb-3">
    <a href="{{ route('gio-hang') }}" >
        ← Quay lại giỏ hàng
    </a>
</div>

    <h3 class="mb-4">Thanh toán</h3>

    <div class="row">
        
        <div class="col-md-7">
            
            <div class="card mb-3">
                <div class="card-header fw-bold">
                    Thông tin giao hàng
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Tên người nhận</label>
                        <input type="text" class="form-control" placeholder="Nhập tên người nhận">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Số điện thoại</label>
                        <input type="text" class="form-control" placeholder="Nhập số điện thoại">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ giao hàng</label>
                        <textarea class="form-control" rows="3"
                                  placeholder="Số nhà, đường, phường/xã, quận/huyện"></textarea>
                    </div>
                </div>
            </div>

            
            <div class="card mb-3">
                <div class="card-header fw-bold">
                    Phương thức thanh toán
                </div>
                <div class="card-body">
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment" checked>
                        <label class="form-check-label">
                            Thanh toán khi nhận hàng (COD)
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment">
                        <label class="form-check-label">
                            Chuyển khoản ngân hàng
                        </label>
                    </div>

                    <div class="form-check mb-2">
                        <input class="form-check-input" type="radio" name="payment">
                        <label class="form-check-label">
                            Ví điện tử (Momo / VNPay)
                        </label>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="col-md-5">
            <div class="card">
                <div class="card-header fw-bold">
                    Đơn hàng của bạn
                </div>
                <div class="card-body">
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Vợt cầu lông Yonex</span>
                            <span>1.200.000đ</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Giày cầu lông Lining</span>
                            <span>900.000đ</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between fw-bold">
                            <span>Tổng tiền</span>
                            <span class="text-danger">2.100.000đ</span>
                        </li>
                    </ul>

                    <button class="btn btn-success w-100">
                        Đặt hàng
                    </button>

                    <p class="text-muted small mt-2 text-center">
                        Bằng việc đặt hàng, bạn đồng ý với điều khoản mua hàng
                    </p>

                    <div class="text-center mt-3">
    <img src="{{ asset('img/payments.png') }}"
         class="img-fluid"
         style="max-width: 250px"
         alt="Phương thức thanh toán">
</div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
