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
                <th>Giá tiền</th>
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

    <div class="d-flex justify-content-between align-items-center mt-4">
    <h4>
        Tổng tiền:
        <span class="text-danger">
            {{ number_format($total) }}₫
        </span>
    </h4>

    <div>
        <a href="{{ url('/shop') }}" class="btn btn-secondary">
            ← Tiếp tục mua
        </a>

        <a href="{{ route('checkout') }}" class="btn btn-success ms-2">
            Thanh toán
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
</div>


</div>
@endsection
