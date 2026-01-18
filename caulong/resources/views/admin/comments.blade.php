<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý bình luận</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold mb-0">QUẢN LÝ BÌNH LUẬN</h4>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            ← Quay lại
        </a>
    </div>

    <!-- Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-light">
                <tr>
                    <th width="50">#</th>
                    <th>Sản phẩm</th>
                    <th>Người dùng</th>
                    <th>Bình luận</th>
                    <th width="80">Số sao</th>
                    <th width="120">Ngày đánh giá</th>
                    <th width="100" class="text-center">Thao tác</th>
                </tr>
                </thead>

                <tbody>
                @forelse($comments as $index => $cmt)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            {{ $cmt->sanPham->TenSanPham ?? 'Không tồn tại' }}
                        </td>

                        <td>
                            {{ $cmt->nguoiDung->TenNguoiDung ?? 'Ẩn danh' }}
                        </td>

                        <td>
                            {{ $cmt->BinhLuan }}
                        </td>

                        <td>
                            {{ $cmt->SoSao }}/5
                        </td>

                        <td>
                            {{ \Carbon\Carbon::parse($cmt->NgayDanhGia)->format('d/m/Y') }}
                        </td>

                        <!-- NÚT XÓA -->
                        <td class="text-center">
                            <form
                                action="{{ route('admin.comments.destroy', $cmt->MaDanhGia) }}"
                                method="POST"
                                onsubmit="return confirm('Bạn có chắc muốn xóa bình luận này không?')"
                                style="display:inline"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" title="Xóa">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            Chưa có bình luận
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
