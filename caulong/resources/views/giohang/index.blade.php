@extends('layouts.app')

@section('title', 'Giỏ hàng')

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

                {{-- SỐ LƯỢNG --}}
                <td>
                    <input type="number"
                           name="soLuong"
                           value="{{ $item->SoLuong }}"
                           min="1"
                           class="form-control form-control-sm text-center"
                           style="width:70px; margin:auto"
                           form="update-{{ $item->MaBienThe }}">
                </td>

                {{-- THÀNH TIỀN --}}
                <td>
                    {{ number_format($item->SoLuong * $item->bienTheSanPham->GiaBan) }}₫
                </td>

                {{-- THAO TÁC --}}
                <td>
                    <form id="update-{{ $item->MaBienThe }}"
                          action="{{ route('giohang.update', $item->MaBienThe) }}"
                          method="POST"
                          class="mb-1">
                        @csrf
                        <button class="btn btn-sm btn-primary w-100">
                            Cập nhật
                        </button>
                    </form>

                    <form action="{{ route('giohang.remove', $item->MaBienThe) }}"
                          method="POST">
                        @csrf
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

    {{-- TỔNG TIỀN + THANH TOÁN --}}
    <div class="d-flex justify-content-between align-items-center mt-4">
        <h4>
            Tổng tiền:
            <span class="text-danger">
                {{ number_format($total) }}₫
            </span>
        </h4>

        <div>
            <a href="{{ url('/shop') }}" class="btn btn-outline-secondary">
                ← Tiếp tục mua
            </a>

            <a href="#" class="btn btn-success ms-2">
                Thanh toán
            </a>
        </div>
    </div>

</div>
@endsection
