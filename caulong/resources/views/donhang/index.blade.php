@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Quản lý đơn hàng</h3>

    @if($donHangs->isEmpty())
        <div class="alert alert-info">
            Bạn chưa có đơn hàng nào.
        </div>
    @else
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã đơn</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($donHangs as $dh)
            <tr>
                <td>#{{ $dh->MaDonHang }}</td>
                <td>{{ $dh->NgayDat }}</td>
                <td>{{ number_format($dh->TongTien) }}đ</td>
                <td>{{ $dh->TrangThaiDonHang }}</td>
                <td>
                    <a href="{{ route('donhang.show',$dh->MaDonHang) }}" class="btn btn-sm btn-primary">
                        Xem
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
