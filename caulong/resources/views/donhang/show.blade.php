@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Chi tiết đơn hàng #{{ $donHang->MaDonHang }}</h4>

    <p><b>Người nhận:</b> {{ $donHang->TenNguoiNhan }}</p>
    <p><b>Địa chỉ:</b> {{ $donHang->DiaChiGiaoHang }}</p>
    <p><b>Trạng thái:</b> {{ $donHang->TrangThaiDonHang }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Biến thể</th>
                <th>SL</th>
                <th>Đơn giá</th>
            </tr>
        </thead>
        <tbody>
        @foreach($donHang->chiTiet as $ct)
            <tr>
                <td>{{ $ct->bienThe->sanPham->TenSanPham ?? '' }}</td>
                <td>{{ $ct->bienThe->TenBienThe }}</td>
                <td>{{ $ct->SoLuong }}</td>
                <td>{{ number_format($ct->DonGia) }}đ</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if($donHang->TrangThaiDonHang == 'ChoXuLy')
        <form method="POST" action="{{ route('donhang.cancel',$donHang->MaDonHang) }}">
            @csrf
            <button class="btn btn-danger"
                onclick="return confirm('Bạn có chắc muốn huỷ đơn?')">
                Huỷ đơn
            </button>
        </form>
    @endif
</div>
@endsection
