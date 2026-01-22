<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý loại sản phẩm</title>

    <!-- Bootstrap 4 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold mb-0">QUẢN LÝ LOẠI SẢN PHẨM</h4>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            ← Quay lại Admin
        </a>
    </div>

    <!-- SEARCH + ADD -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="GET">
                <input
                    type="text"
                    name="keyword"
                    value="{{ request('keyword') }}"
                    class="form-control"
                    placeholder="🔍 Tìm danh mục..."
                >
            </form>
        </div>

        <div class="col-md-6 text-right">
            <button class="btn btn-danger" data-toggle="modal" data-target="#addCategoryModal">
                + Thêm loại sản phẩm
            </button>
        </div>
    </div>

    <!-- TABLE -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-dark">
                <tr class="text-center">
                    <th width="45%">Tên loại</th>
                    <th width="20%">Loại</th>
                    <th width="35%">Thao tác</th>
                </tr>
                </thead>

                <tbody>
                @forelse($categories as $parent)
                    <!-- DANH MỤC CHA -->
                    <tr>
                        <td><strong>{{ $parent->TenDanhMuc }}</strong></td>
                        <td class="text-center text-muted">Danh mục cha</td>
                        <td class="text-center">

                            <!-- SỬA -->
                            <button
                                class="btn btn-warning btn-sm btn-edit"
                                data-id="{{ $parent->MaDanhMuc }}"
                                data-name="{{ $parent->TenDanhMuc }}"
                                data-parent="{{ $parent->DanhMucCha }}"
                                data-toggle="modal"
                                data-target="#editCategoryModal"
                            >
                                Sửa
                            </button>

                            <!-- XÓA -->
                            <form
                                method="POST"
                                action="{{ route('admin.categories.destroy', $parent->MaDanhMuc) }}"
                                class="d-inline"
                                onsubmit="return confirm('Xóa danh mục này và toàn bộ danh mục con?')"
                            >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Xóa</button>
                            </form>

                        </td>
                    </tr>

                    <!-- DANH MỤC CON -->
                    @foreach($parent->children as $child)
                        <tr>
                            <td class="pl-4">└─ {{ $child->TenDanhMuc }}</td>
                            <td class="text-center text-muted">Danh mục con</td>
                            <td class="text-center">

                                <!-- SỬA -->
                                <button
                                    class="btn btn-warning btn-sm btn-edit"
                                    data-id="{{ $child->MaDanhMuc }}"
                                    data-name="{{ $child->TenDanhMuc }}"
                                    data-parent="{{ $child->DanhMucCha }}"
                                    data-toggle="modal"
                                    data-target="#editCategoryModal"
                                >
                                    Sửa
                                </button>

                                <!-- XÓA -->
                                <form
                                    method="POST"
                                    action="{{ route('admin.categories.destroy', $child->MaDanhMuc) }}"
                                    class="d-inline"
                                    onsubmit="return confirm('Xóa danh mục con này?')"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Xóa</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">
                            Chưa có loại sản phẩm nào
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-3 d-flex justify-content-center">
        {{ $categories->links() }}
    </div>

</div>

<!-- ================= MODAL THÊM ================= -->
<div class="modal fade" id="addCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" action="{{ route('admin.categories.store') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Thêm danh mục</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input name="TenDanhMuc" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Danh mục cha</label>
                        <select name="DanhMucCha" class="form-control">
                            <option value="">-- Không có --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->MaDanhMuc }}">
                                    {{ $cat->TenDanhMuc }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Lưu</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ================= MODAL SỬA ================= -->
<div class="modal fade" id="editCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="POST" id="editCategoryForm">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title">Cập nhật danh mục</h5>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên danh mục</label>
                        <input id="editTenDanhMuc" name="TenDanhMuc" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label>Danh mục cha</label>
                        <select id="editDanhMucCha" name="DanhMucCha" class="form-control">
                            <option value="">-- Không có --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->MaDanhMuc }}">
                                    {{ $cat->TenDanhMuc }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Cập nhật</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Hủy</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function () {
    $('.btn-edit').on('click', function () {
        let id = $(this).data('id');
        let name = $(this).data('name');
        let parent = $(this).data('parent');

        $('#editTenDanhMuc').val(name);
        $('#editDanhMucCha').val(parent);

        $('#editCategoryForm').attr('action', '/admin/categories/' + id);
    });
});
</script>

</body>
</html>
