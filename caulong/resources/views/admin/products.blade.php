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
                            <td>{{ $sanPhams->firstItem() + $index }}</td>

                            <td>{{ $sp->TenSanPham }}</td>

                            <td>
                                {{ number_format(optional($sp->bienThes->first())->GiaBan) }} đ
                            </td>

                            <td>
                                {{ optional($sp->bienThes->first())->SoLuongTon }}
                            </td>

                            <td>
                                @if ($sp->TrangThai ?? true)
                                    <span class="badge badge-success">Đang bán</span>
                                @else
                                    <span class="badge badge-secondary">Ẩn</span>
                                @endif
                            </td>

                            <td class="text-center">
                                <button class="btn btn-sm btn-warning text-white">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('admin.products.destroy', $sp->MaSanPham) }}"
                                    method="POST"
                                    style="display:inline-block"
                                    onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
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
            <div class="p-3">
                {{ $sanPhams->links() }}
            </div>
        </div>
    </div>

</div>

</body>
</html>
