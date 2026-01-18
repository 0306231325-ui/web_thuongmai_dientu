<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="font-weight-bold mb-0">Quản lý sản phẩm</h4>

        <div class="d-flex align-items-center">
            <!-- Search -->
            <form method="GET" class="form-inline mr-2">
                <input
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    class="form-control mr-2"
                    placeholder="Tìm sản phẩm..."
                >
                <button class="btn btn-outline-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>

            <!-- Add button -->
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Thêm sản phẩm
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="60">#</th>
                        <th>Tên sản phẩm</th>
                        <th width="120">Giá bán</th>
                        <th width="120">Số lượng</th>
                        <th width="120">Trạng thái</th>
                        <th width="160" class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($sanPhams as $index => $sp)
                    <tr>
                        <!-- STT -->
                        <td>{{ $index + 1 }}</td>

                        <!-- TÊN -->
                        <td>{{ $sp->TenSanPham }}</td>

                        <!-- GIÁ -->
                        <td>
                            {{ number_format(optional($sp->bienThes->first())->GiaBan) }} đ
                        </td>

                        <!-- SỐ LƯỢNG -->
                        <td>
                            {{ optional($sp->bienThes->first())->SoLuongTon }}
                        </td>

                        <!-- TRẠNG THÁI -->
                        <td>
                            @if ($sp->TrangThai ?? true)
                                <span class="badge badge-success">Đang bán</span>
                            @else
                                <span class="badge badge-secondary">Ẩn</span>
                            @endif
                        </td>

                        <!-- THAO TÁC -->
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning text-white" title="Sửa">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-danger" title="Xóa">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            Chưa có sản phẩm
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

</body>
</html>
