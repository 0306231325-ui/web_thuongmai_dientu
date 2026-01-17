@extends('layouts.app')

@section('title', 'Săn Mã Giảm Giá')

@section('content')

<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Kho Mã Giảm Giá</span></h2>
        <p>Lưu ngay voucher để được giảm giá khi thanh toán nhé!</p>
    </div>

    <div class="row px-xl-5">
        @foreach($vouchers as $voucher)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    
                    <div class="card-header bg-primary text-white text-center">
                        <h5 class="m-0 text-white">
                            GIẢM 
                            {{ $voucher->PhanTramGiam > 0 ? $voucher->PhanTramGiam . '%' : number_format($voucher->GiaTriGiamToiDa/1000) . 'k' }}
                        </h5>
                    </div>
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $voucher->TenChuongTrinh }}</h5>
                        
                        <p class="card-text mb-2">
                            <strong>Mã:</strong> 
                            <span class="badge badge-warning" style="font-size: 1em;">{{ $voucher->MaCode }}</span>
                        </p>
                        
                        <p class="card-text small text-muted mb-4">
                            Đơn tối thiểu: {{ number_format($voucher->DonHangToiThieu, 0, ',', '.') }}đ<br>
                            HSD: {{ \Carbon\Carbon::parse($voucher->NgayKetThuc)->format('d/m/Y') }}
                        </p>

                        <div class="mt-auto">
                            @if(in_array($voucher->MaKhuyenMai, $myVouchers))
                                <button class="btn btn-secondary btn-block" disabled>Đã Lưu</button>
                            @else
                                <button 
                                    class="btn btn-primary btn-block btn-save-voucher" 
                                    data-code="{{ $voucher->MaCode }}"
                                    data-url="{{ route('voucher.save') }}" 
                                    data-token="{{ csrf_token() }}">
                                    Lưu Ngay
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endforeach

        @if($vouchers->isEmpty())
            <div class="col-12 text-center">
                <p>Hiện tại chưa có mã giảm giá nào mới.</p>
            </div>
        @endif
    </div>
</div>



@endsection