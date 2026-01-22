@extends('layouts.app')

@section('title', 'Giỏ hàng')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@section('content')
<div class="container mt-4">

    <h2 class="mb-4">Giỏ hàng</h2>
    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>Sản phẩm</th>
                <th>Biến thể</th>
                <th>Đơn giá</th>
                <th style="width:140px">Số lượng</th>
                <th>Thành tiền</th>
                <th style="width:130px">Thao tác</th>
            </tr>
        </thead>

        <tbody>
        @forelse($items as $item)
            <tr>
                <td>{{ $item->bienTheSanPham->sanPham->TenSanPham }}</td>
                <td>{{ $item->bienTheSanPham->TenBienThe }}</td>
                <td>{{ number_format($item->bienTheSanPham->GiaBan) }}₫</td>

                <td>
                    <input type="number"
                           name="soLuong"
                           value="{{ $item->SoLuong }}"
                           min="1"
                           class="form-control form-control-sm text-center"
                           style="width:70px; margin:auto"
                           form="update-{{ $item->MaBienThe }}">
                </td>

                <td>
                    {{ number_format($item->SoLuong * $item->bienTheSanPham->GiaBan) }}₫
                </td>

                <td>
                    <form id="update-{{ $item->MaBienThe }}"
                          action="{{ route('gio-hang.update', $item->MaBienThe) }}"
                          method="POST"
                          class="mb-1">
                        @csrf
                        <button class="btn btn-sm btn-primary w-100">
                            Cập nhật
                        </button>
                    </form>

                    <form action="{{ route('gio-hang.remove', $item->MaBienThe) }}"
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger w-100"
                                onclick="return confirm('Xóa sản phẩm này?')">
                            Xóa
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-muted">
                    Giỏ hàng trống
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $items->links('pagination::bootstrap-4') }}
    </div>

    <div class="row justify-content-end mt-4">
        <div class="col-lg-4 col-md-6">
            
            <div class="card mb-3">
                <div class="card-header bg-white font-weight-bold">
                     Voucher Shop
                </div>
                <div class="card-body">
                    
                    
                    <form action="{{ route('gio-hang.apply-voucher') }}" method="POST" id="form-apply-voucher">
                        @csrf
                        <input type="hidden" name="coupon_code" id="hidden_coupon_input">
                    </form>

                
                    @if(session('coupon'))
                       
                        <div class="border rounded p-2 d-flex justify-content-between align-items-center bg-success text-white">
                            <div>
                                <i class="fa fa-check-circle"></i> 
                                <span class="font-weight-bold">{{ session('coupon')['code'] }}</span>
                                <br>
                                <small>Đã giảm: {{ number_format(session('coupon')['discount']) }}₫</small>
                            </div>
                            <form action="{{ route('gio-hang.remove-voucher') }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-light text-danger font-weight-bold">Bỏ chọn</button>
                            </form>
                        </div>
                    @else
                     
                        <button type="button" 
                                class="btn btn-outline-primary btn-block d-flex justify-content-between align-items-center p-3"
                                data-toggle="modal" 
                                data-target="#voucherModal">
                            <span><i class="fa fa-plus-circle"></i> Chọn mã</span>
                            <i class="fa fa-chevron-right small"></i>
                        </button>
                        
                        <small class="text-muted mt-2 d-block text-center">
                            Bấm vào để xem kho voucher của bạn
                        </small>
                    @endif

                    @if(session('error_coupon'))
                        <div class="alert alert-danger mt-2 p-2 small mb-0">
                            <i class="fa fa-exclamation-circle"></i> {{ session('error_coupon') }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="card bg-light">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tạm tính:</span>
                        <span class="fw-bold">{{ number_format($total) }}₫</span>
                    </div>

                    @if(session('coupon'))
                        <div class="d-flex justify-content-between mb-2 text-success">
                            <span>Voucher giảm giá:</span>
                            <span>-{{ number_format(session('coupon')['discount']) }}₫</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0">Tổng thanh toán:</h5>
                            <h5 class="mb-0 text-danger">
                                {{ number_format($total - session('coupon')['discount']) }}₫
                            </h5>
                        </div>
                    @else
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h5 class="mb-0">Tổng tiền:</h5>
                            <h5 class="mb-0 text-danger">{{ number_format($total) }}₫</h5>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>


    <div class="d-flex justify-content-between align-items-center mt-4 pb-5">
        <div>
            <a href="{{ url('/shop') }}" class="btn btn-secondary">
                ← Tiếp tục mua
            </a>
            
            <form action="{{ route('gio-hang.clear') }}" method="POST" 
                  class="d-inline-block ms-2" 
                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa tất cả sản phẩm trong giỏ hàng?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    Xóa hết giỏ hàng
                </button>
            </form>
        </div>

        <a href="{{ route('checkout') }}" class="btn btn-success btn-lg px-5">
            Thanh toán <i class="fa fa-arrow-right ms-2"></i>
        </a>
    </div>

</div>

<div class="modal fade" id="voucherModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Chọn Mã Giảm Giá</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                
                @if(isset($myVouchers) && $myVouchers->count() > 0)
                    <div class="row">
                        @foreach($myVouchers as $vc)
                            <div class="col-12 mb-3">
                                    <div class="card-body p-3">
                                        <div class="row align-items-center">
                                            <div class="col-3 text-center border-right">

                                                <div class="bg-light rounded p-2">
                                                    <span class="h5 font-weight-bold text-danger d-block mb-0">
                                                        {{ $vc->PhanTramGiam > 0 ? $vc->PhanTramGiam . '%' : 'GIẢM' }}
                                                    </span>
                                                </div>

                                            </div>

                                        
                                            <div class="col-6">
                                                <h6 class="font-weight-bold mb-1">{{ $vc->TenChuongTrinh }}</h6>
                                                <span class="badge badge-secondary border mb-1">{{ $vc->MaCode }}</span>
                                                <p class="text-muted small mb-0">
                                                    Đơn tối thiểu: {{ number_format($vc->DonHangToiThieu) }}₫ <br>
                                                    HSD: {{ $vc->NgayKetThuc->format('d/m/Y') }}
                                                </p>

                                                @if(!$vc->checkDieuKien($total))
                                                    <small class="text-danger font-italic">
                                                        Mua thêm {{ number_format($vc->DonHangToiThieu - $total) }}₫
                                                    </small>
                                                @endif
                                            </div>
                                            <div class="col-3 text-right">
                                                @if($vc->checkDieuKien($total))
                                                    <button type="button" 
                                                            class="btn btn-primary btn-sm btn-select-voucher"
                                                            data-code="{{ $vc->MaCode }}">
                                                        Áp dụng
                                                    </button>
                                                @else
                                                    <button class="btn btn-secondary btn-sm" disabled>Chưa đủ ĐK</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <p class="text-muted mt-3">Bạn chưa có voucher nào.</p>
                        <a href="{{ route('khuyenmai.index') }}" class="btn btn-outline-primary">Săn voucher ngay</a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>



@endsection