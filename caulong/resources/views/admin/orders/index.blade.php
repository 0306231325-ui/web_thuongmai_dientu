<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý đơn hàng</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between mb-3">
        <h4 class="font-weight-bold">QUẢN LÝ ĐƠN HÀNG</h4>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            ← Quay lại
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Người đặt</th>
                    <th>Người nhận</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th width="120" class="text-center">Thao tác</th>
                </tr>
                </thead>

                <tbody>
                @forelse($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            {{ $order->nguoiDung->TenNguoiDung ?? 'Khách' }}
                        </td>

                        <td>{{ $order->TenNguoiNhan }}</td>

                        <td>{{ $order->NgayDat?->format('d/m/Y') }}</td>

                        <td class="text-danger font-weight-bold">
                            {{ number_format($order->TongTien) }} đ
                        </td>

                        <td>
                        @php
                            $current = $order->TrangThaiDonHang;
                        @endphp

                        @if(in_array($current, ['DaGiao', 'DaHuy']))
                            <span class="font-weight-bold text-muted">
                                {{ $current }}
                            </span>
                        @else
                            <form action="{{ route('admin.orders.updateStatus', $order->MaDonHang) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <select name="TrangThaiDonHang"
                                        class="form-control form-control-sm"
                                        onchange="this.form.submit()">

                                    {{-- ChoXuLy --}}
                                    @if($current === 'ChoXuLy')
                                        <option value="ChoXuLy" selected>Chờ xử lý</option>
                                        <option value="DangGiao">Đang giao</option>
                                        <option value="DaHuy">Đã hủy</option>
                                    @endif

                                    {{-- DangGiao --}}
                                    @if($current === 'DangGiao')
                                        <option value="DangGiao" selected>Đang giao</option>
                                        <option value="DaGiao">Đã giao</option>
                                    @endif

                                </select>
                            </form>
                        @endif
                    </td>
                        <td class="text-center">
                            @if($order->TrangThaiDonHang === 'DaHuy')
                                <form action="{{ route('admin.orders.destroy', $order->MaDonHang) }}"
                                    method="POST"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa đơn hàng này?')"
                                    style="display:inline-block">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">Không thể xóa</span>
                            @endif
                        </td>

                       
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Chưa có đơn hàng
                        </td>
                    </tr>
                @endforelse
                </tbody>

            </table>
            <div class="p-3">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

</div>

</body>
</html>
