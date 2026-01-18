<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Doanh Thu</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/doanhthu.css') }}">
</head>
<body>

<div class="container">
    <a href="{{ route('admin.index') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Quay về Dashboard</a>

    <h2 class="text-center mb-4 text-uppercase">Báo cáo doanh thu: {{ $title }}</h2>

    <div class="filter-bar">
        <a href="?filter=ngay" class="filter-btn {{ $filter == 'ngay' ? 'active' : '' }}">Hôm nay</a>
        <a href="?filter=tuan" class="filter-btn {{ $filter == 'tuan' ? 'active' : '' }}">Tuần này</a>
        <a href="?filter=thang" class="filter-btn {{ $filter == 'thang' ? 'active' : '' }}">Tháng này</a>
        <a href="?filter=nam" class="filter-btn {{ $filter == 'nam' ? 'active' : '' }}">Năm nay</a>
    </div>

    <div class="stats-grid">
        <div class="stat-card card-revenue">
            <i class="fas fa-coins" style="color: #28a745"></i>
            <h3>{{ number_format($tongDoanhThu, 0, ',', '.') }} ₫</h3>
            <p>Doanh Thu Thực Tế</p>
        </div>

        <div class="stat-card card-success">
            <i class="fas fa-check-circle" style="color: #0d6efd"></i>
            <h3>{{ $donThanhCong }}</h3>
            <p>Đơn Thành Công</p>
        </div>

        <div class="stat-card card-waiting" data-toggle="modal" data-target="#detailModal">
            <i class="fas fa-clock" style="color: #ffc107"></i>
            <h3>{{ $donChoXuLy + $donDangGiao }}</h3>
            <p>Đang Chờ / Giao <small>(Click xem)</small></p>
        </div>

        <div class="stat-card card-cancel">
            <i class="fas fa-times-circle" style="color: #dc3545"></i>
            <h3>{{ $cntDonHuy }}</h3>
            <p>Đơn Đã Hủy</p>
        </div>
    </div>
    
    </div>

<div class="modal fade" id="detailModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title font-weight-bold">Chi tiết đơn Đang Chờ / Đang Giao</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row text-center mb-3">
                    <div class="col-6 border-right">
                        <h6 class="text-primary font-weight-bold">THANH TOÁN ONLINE</h6>
                        <h3 class="text-primary">{{ $chiTietOnline }} <small>đơn</small></h3>
                        <p class="text-muted mb-0">Tiền đã về ví</p>
                        <span class="badge badge-pill badge-primary">{{ number_format($tienOnline) }} ₫</span>
                    </div>
                    <div class="col-6">
                        <h6 class="text-secondary font-weight-bold">THANH TOÁN COD</h6>
                        <h3 class="text-secondary">{{ $chiTietCOD }} <small>đơn</small></h3>
                        <p class="text-muted mb-0">Shipper đang thu</p>
                        <span class="badge badge-pill badge-secondary">{{ number_format($tienCOD) }} ₫</span>
                    </div>
                </div>
                <div class="alert alert-info mb-0" style="font-size: 13px;">
                    <i class="fas fa-info-circle"></i> 
                    <b>Lưu ý:</b> Đơn Online được tính ngay vào doanh thu. Đơn COD chỉ được tính khi giao thành công.
                </div>
            </div>
            <div class="modal-footer p-1">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>