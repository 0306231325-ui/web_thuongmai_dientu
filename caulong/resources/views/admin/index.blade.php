<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quản trị Admin</title>

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

    <!-- Quay về trang chủ -->
    <a href="{{ route('home') }}" class="btn btn-secondary mb-4">
        <i class="fas fa-arrow-left"></i> Quay về trang chủ
    </a>

    <!-- Title -->
    <div class="text-center mb-5">
        <h2 class="font-weight-bold text-uppercase">Trang quản trị Admin</h2>
        <p class="text-muted">Quản lý toàn bộ hệ thống cửa hàng</p>
    </div>

    <!-- ROW 1 - CHỨC NĂNG CŨ -->
    <div class="row">

        <!-- Quản lý hóa đơn -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-file-invoice fa-3x text-primary mb-3"></i>
                    <h6 class="font-weight-bold">Quản lý hóa đơn</h6>
                    <a href="{{ route('admin.orders') }}" class="btn btn-primary btn-block">Truy cập</a>
                </div>
            </div>
        </div>

        <!-- Quản lý sản phẩm -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-box-open fa-3x text-success mb-3"></i>
                    <h6 class="font-weight-bold">Quản lý sản phẩm</h6>
                    <a href="{{ route('admin.products') }}" class="btn btn-success btn-block">Truy cập</a>
                </div>
            </div>
        </div>

        <!-- Quản lý loại sản phẩm -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-list-alt fa-3x text-danger mb-3"></i>
                    <h6 class="font-weight-bold">Quản lý loại sản phẩm</h6>
                    <a href="{{ route('admin.categories') }}" class="btn btn-danger btn-block">Truy cập</a>
                </div>
            </div>
        </div>

        <!-- Quản lý bình luận -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-comments fa-3x text-warning mb-3"></i>
                    <h6 class="font-weight-bold">Quản lý bình luận</h6>
                    <a href="{{ route('admin.comments') }}" class="btn btn-warning btn-block text-white">Truy cập</a>
                </div>
            </div>
        </div>

    </div>

    <!-- ROW 2 - CHỨC NĂNG MỚI (CHƯA CẦN LINK) -->
    <div class="row">

        <!-- Quản lý vận chuyển -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-truck fa-3x text-info mb-3"></i>
                    <h6 class="font-weight-bold">Quản lý vận chuyển</h6>
                    <a href="#" class="btn btn-info btn-block disabled">Sắp có</a>
                </div>
            </div>
        </div>

        <!-- Hỗ trợ khách hàng -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-headset fa-3x text-secondary mb-3"></i>
                    <h6 class="font-weight-bold">Hỗ trợ khách hàng</h6>
                    <a href="#" class="btn btn-secondary btn-block disabled">Sắp có</a>
                </div>
            </div>
        </div>

        <!-- Nhà cung cấp -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-industry fa-3x text-dark mb-3"></i>
                    <h6 class="font-weight-bold">Nhà cung cấp</h6>
                    <a href="#" class="btn btn-dark btn-block disabled">Sắp có</a>
                </div>
            </div>
        </div>

        <!-- Khuyến mãi -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm h-100">
                <div class="card-body">
                    <i class="fas fa-tags fa-3x text-danger mb-3"></i>
                    <h6 class="font-weight-bold">Quản lý khuyến mãi</h6>
                    <a href="#" class="btn btn-danger btn-block disabled">Sắp có</a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
