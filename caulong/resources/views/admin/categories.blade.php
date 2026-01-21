<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý loại sản phẩm</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold mb-0">QUẢN LÝ LOẠI SẢN PHẨM</h4>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            ← Quay lại Admin
        </a>
    </div>

    <div class="mb-3 text-right">
        <button class="btn btn-danger">
            + Thêm loại sản phẩm
        </button>
    </div>

    <div class="card">
        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>Tên loại</th>
                        <th>Mô tả</th>
                        <th>Trạng thái</th>
                        <th width="15%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

        </div>
    </div>

    <div class="text-center text-muted mt-4">
        Chưa có loại sản phẩm nào
    </div>

</div>

</body>
</html>
