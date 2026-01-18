<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Admin</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            background-color: #f4f6f9;
            padding: 40px;
        }

        .top-bar {
            max-width: 1100px;
            margin: 0 auto 20px;
        }

        .btn-home {
            display: inline-block;
            padding: 8px 14px;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-home i {
            margin-right: 5px;
        }

        .admin-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .admin-title i {
            font-size: 40px;
            color: #333;
            margin-bottom: 10px;
        }

        .admin-title h2 {
            margin: 0;
            font-size: 28px;
        }

        .dashboard {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            max-width: 1100px;
            margin: auto;
        }

        .dashboard-item {
            background: #ffffff;
            border-radius: 8px;
            padding: 25px 15px;
            text-align: center;
            text-decoration: none;
            color: #333;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: 0.3s;
        }

        .dashboard-item i {
            font-size: 36px;
            margin-bottom: 12px;
            color: #0d6efd;
        }

        .dashboard-item:hover {
            transform: translateY(-5px);
            background-color: #f1f1f1;
        }

        .dashboard-item span {
            display: block;
            font-size: 16px;
            font-weight: bold;
        }

        @media (max-width: 992px) {
            .dashboard {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Nút quay về trang chủ -->
    <div class="top-bar">
        <a href="{{ url('/') }}" class="btn-home">
            <i class="fas fa-arrow-left"></i> Quay về trang chủ
        </a>
    </div>

    <!-- Tiêu đề -->
    <div class="admin-title">
        <i class="fas fa-user-shield"></i>
        <h2>QUẢN LÝ ADMIN</h2>
    </div>

    <!-- Dashboard -->
    <div class="dashboard">

        <a href="{{ url('/admin/products') }}" class="dashboard-item">
            <i class="fas fa-box"></i>
            <span>Quản lý sản phẩm</span>
        </a>

        <a href="{{ url('/admin/categories') }}" class="dashboard-item">
            <i class="fas fa-list"></i>
            <span>Loại sản phẩm</span>
        </a>

        <a href="{{ url('/admin/orders') }}" class="dashboard-item">
            <i class="fas fa-file-invoice"></i>
            <span>Hóa đơn</span>
        </a>

        <a href="{{ url('/admin/shipping') }}" class="dashboard-item">
            <i class="fas fa-truck"></i>
            <span>Vận chuyển</span>
        </a>

        <a href="{{ url('/admin/users') }}" class="dashboard-item">
            <i class="fas fa-users"></i>
            <span>Quản lý tài khoản</span>
        </a>

        <a href="{{ url('/admin/comments') }}" class="dashboard-item">
            <i class="fas fa-comments"></i>
            <span>Quản lý bình luận</span>
        </a>

        <a href="{{ url('/admin/contact') }}" class="dashboard-item">
            <i class="fas fa-envelope"></i>
            <span>Liên hệ</span>
        </a>

        <a href="{{ url('/admin/support') }}" class="dashboard-item">
            <i class="fas fa-headset"></i>
            <span>Hỗ trợ khách hàng</span>
        </a>

        <a href="{{ url('/admin/revenue') }}" class="dashboard-item">
            <i class="fas fa-chart-line"></i>
            <span>Quản lý doanh thu</span>
        </a>

    </div>

</body>
</html>
