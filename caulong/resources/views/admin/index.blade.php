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
                            {{ $order->TrangThaiDonHang }}
                        </td>

                        <td class="text-center">
                            <form
                                action="{{ route('admin.orders.destroy', $order->MaDonHang) }}"
                                method="POST"
                                onsubmit="return confirm('Xóa đơn hàng này?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Xóa
                                </button>
                            </form>
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
                </div>
                </div>

                <div class="mt-3 d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
        </div>
    </div>

</div>

</body>
</html>
