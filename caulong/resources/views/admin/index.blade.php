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

<div class="container mt-5">

    <!-- Title -->
    <div class="text-center mb-5">
        <h2 class="font-weight-bold">TRANG QUẢN TRỊ ADMIN</h2>
        <p class="text-muted">Quản lý hệ thống cửa hàng</p>
    </div>
    <!-- Buttons -->
    <div class="row">

        <!-- Quản lý hóa đơn -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-file-invoice fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Quản lý hóa đơn</h5>
                   <a href="{{ route('admin.orders') }}" class="btn btn-primary btn-block">Truy cập</a>
                </div>
            </div>
        </div>

        <!-- Quản lý sản phẩm -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-box fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Quản lý sản phẩm</h5>
                   <a href="{{ route('admin.products') }}" class="btn btn-success btn-block">Truy cập</a>

                </div>
            </div>
        </div>

        <!-- Quản lý bình luận -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-comments fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Quản lý bình luận</h5>
                  <a href="{{ route('admin.comments') }}" class="btn btn-warning btn-block text-white">Truy cập</a>

                </div>
            </div>
        </div>

        <!-- Quản lý loại sản phẩm -->
        <div class="col-md-3 mb-4">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <i class="fas fa-list fa-3x text-danger mb-3"></i>
                    <h5 class="card-title">Quản lý loại sản phẩm</h5>
                  <a href="{{ route('admin.categories') }}" class="btn btn-danger btn-block">Truy cập</a>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
