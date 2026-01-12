<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý hóa đơn</title>

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>
<body class="bg-light">

<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold mb-0">QUẢN LÝ HÓA ĐƠN</h4>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">
            ← Quay lại 
        </a>
    </div>

    <!-- Filter / Search (chưa hoạt động) -->
    <div class="card mb-4">
        <div class="card-body">
            <form class="form-inline">
                <input
                    type="text"
                    class="form-control mr-2 mb-2"
                    placeholder="Mã hóa đơn..."
                >
                <input
                    type="text"
                    class="form-control mr-2 mb-2"
                    placeholder="Tên khách hàng..."
                >
                <button type="button" class="btn btn-primary mb-2">
                    Tìm kiếm
                </button>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="card">
        <div class="card-body p-0">

            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>Mã hóa đơn</th>
                        <th>Khách hàng</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th width="15%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- CHƯA CÓ DỮ LIỆU -->
                </tbody>
            </table>

        </div>
    </div>

    <!-- Empty State -->
    <div class="text-center text-muted mt-4">
        Chưa có hóa đơn nào
    </div>

</div>

</body>
</html>
