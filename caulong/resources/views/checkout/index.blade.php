@extends('layouts.app')
@section('title', 'Thanh toán')
@section('content')
<div class="container mt-4">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="mb-4">Thanh toán</h2>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header checkout-card-header bg-white">
                        <h5 class="mb-0 fw-bold">1. Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($addresses) && $addresses->count() > 0)
                            <div class="mb-3">
                                <label class="form-label fw-bold">Chọn từ sổ địa chỉ:</label>
                                <select class="form-select" id="address-selector">
                                    <option value="">-- Chọn địa chỉ --</option>
                                    @foreach($addresses as $addr)
                                        <option value="{{ $addr->DiaChiChiTiet }}" 
                                                data-name="{{ $addr->TenNguoiNhan }}" 
                                                data-phone="{{ $addr->SoDienThoai }}">
                                            {{ $addr->TenNguoiNhan }} - {{ $addr->SoDienThoai }} ({{ Str::limit($addr->DiaChiChiTiet, 30) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="text-center my-2 text-muted small">- Hoặc nhập mới bên dưới -</div>
                        @endif

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Họ tên người nhận</label>
                                <input type="text" class="form-control" name="TenNguoiNhan" id="inputName" required value="{{ Auth::user()->HoTen }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="SoDienThoai" id="inputPhone" required value="{{ Auth::user()->SoDienThoai }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Địa chỉ chi tiết</label>
                                <textarea class="form-control" name="DiaChiGiaoHang" id="inputAddress" rows="2" required placeholder="Số nhà, đường, phường, quận..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Ghi chú đơn hàng (Tùy chọn)</label>
                                <textarea class="form-control" name="GhiChu" rows="1" placeholder="Ví dụ: Giao giờ hành chính..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4 shadow-sm">
                    <div class="card-header checkout-card-header bg-white">
                        <h5 class="mb-0 fw-bold">2. Phương thức thanh toán</h5>
                    </div>
                    <div class="card-body">
                        @foreach($paymentMethods as $method)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="MaPhuongThucTT" 
                                       id="payment{{ $method->MaPhuongThuc }}" 
                                       value="{{ $method->MaPhuongThuc }}" 
                                       {{ $loop->first ? 'checked' : '' }}>
                                <label class="form-check-label" for="payment{{ $method->MaPhuongThuc }}">
                                    {{ $method->TenPhuongThuc }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card shadow-sm border-primary">
                    <div class="card-header checkout-card-header bg-primary text-white">
                        <h5 class="mb-0">Đơn hàng của bạn ({{ $cartItems->count() }})</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($cartItems as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        @php
                                            $hinhAnh = optional($item->bienTheSanPham->sanPham->hinhAnhChinh)->DuongDan ?? 'no-image.png';
                                        @endphp

                                        <img src="{{ asset('img/hinhanhsanpham/' . $hinhAnh) }}"
                                             class="checkout-product-img me-2 border rounded"
                                             style="width: 50px; height: 50px; object-fit: cover;"
                                             alt="Ảnh sản phẩm">
                                        
                                        <div>
                                            <div class="checkout-product-name fw-bold small">
                                                {{ Str::limit($item->bienTheSanPham->sanPham->TenSanPham, 25) }}
                                            </div>
                                            <small class="text-muted">
                                                {{ $item->bienTheSanPham->TenBienThe }} <br> 
                                                SL: x{{ $item->SoLuong }}
                                            </small>
                                        </div>
                                    </div>
                                    <span class="text-primary fw-bold">
                                        {{ number_format($item->SoLuong * $item->bienTheSanPham->GiaBan) }}₫
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span>{{ number_format($total) }}₫</span>
                        </div>
                        @if(session('coupon'))
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>
                                     Voucher ({{ session('coupon')['code'] }}):
                                </span>
                                <span>-{{ number_format($discount ?? 0) }}₫</span>
                            </div>
                        @endif
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span class="text-success">Miễn phí</span> 
                        </div>
                        
                        <hr>
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-bold">Tổng thanh toán:</h5>
                            <h4 class="checkout-total-price text-danger fw-bold">{{ number_format($finalTotal ?? $total) }}₫</h4>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 btn-lg mt-3 fw-bold" onclick="return confirm('Xác nhận đặt hàng?')">
                            ĐẶT HÀNG NGAY
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



@endsection