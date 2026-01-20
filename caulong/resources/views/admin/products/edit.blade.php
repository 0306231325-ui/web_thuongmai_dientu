<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h4 class="mb-3">Sửa sản phẩm</h4>

    <form action="{{ route('admin.products.update', $sanPham->MaSanPham) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Tên sản phẩm</label>
            <input type="text" name="TenSanPham"
                   value="{{ old('TenSanPham', $sanPham->TenSanPham) }}"
                   class="form-control">
        </div>

        <div class="form-group">
            <label>Danh mục</label>
            <select name="MaDanhMuc" class="form-control">
                @foreach ($danhMucs as $dm)
                    <option value="{{ $dm->MaDanhMuc }}"
                        {{ $sanPham->MaDanhMuc == $dm->MaDanhMuc ? 'selected' : '' }}>
                        {{ $dm->TenDanhMuc }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Thương hiệu</label>
            <select name="MaThuongHieu" class="form-control">
                @foreach ($thuongHieus as $th)
                    <option value="{{ $th->MaThuongHieu }}"
                        {{ $sanPham->MaThuongHieu == $th->MaThuongHieu ? 'selected' : '' }}>
                        {{ $th->TenThuongHieu }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Giá bán</label>
            <input type="number" name="GiaBan"
                   value="{{ old('GiaBan', optional($sanPham->bienThes->first())->GiaBan) }}"
                   class="form-control">
        </div>

        <div class="form-group">
            <label>Số lượng tồn</label>
            <input type="number" name="SoLuongTon"
                   value="{{ old('SoLuongTon', optional($sanPham->bienThes->first())->SoLuongTon) }}"
                   class="form-control">
        </div>

        <div class="form-group">
            <label>Hình ảnh mới (nếu đổi)</label>
            <input type="file" name="HinhAnh" class="form-control-file">
        </div>

        <button class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            Quay lại
        </a>
    </form>
</div>

</body>
</html>
