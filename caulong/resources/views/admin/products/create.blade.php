<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }
        .card {
            border-radius: 12px;
        }
        .card-header {
            border-radius: 12px 12px 0 0;
        }
        label {
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-8">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">➕ Thêm sản phẩm mới</h5>
                </div>

                <div class="card-body">

                    {{-- Hiển thị lỗi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.products.store') }}" method="POST">
                        @csrf

                        {{-- Tên sản phẩm --}}
                        <div class="mb-3">
                            <label class="form-label">Tên sản phẩm</label>
                            <input type="text"
                                   name="TenSanPham"
                                   class="form-control"
                                   placeholder="Nhập tên sản phẩm"
                                   value="{{ old('TenSanPham') }}"
                                   required>
                        </div>

                        {{-- Mô tả --}}
                        <div class="mb-3">
                            <label class="form-label">Mô tả chi tiết</label>
                            <textarea name="MoTaChiTiet"
                                      class="form-control"
                                      rows="4"
                                      placeholder="Mô tả sản phẩm">{{ old('MoTaChiTiet') }}</textarea>
                        </div>

                        <div class="row">
                            {{-- Danh mục --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Danh mục</label>
                                <select name="MaDanhMuc" class="form-select" required>
                                    <option value="">-- Chọn danh mục --</option>
                                    @foreach ($danhMucs as $dm)
                                        <option value="{{ $dm->MaDanhMuc }}"
                                            {{ old('MaDanhMuc') == $dm->MaDanhMuc ? 'selected' : '' }}>
                                            {{ $dm->TenDanhMuc }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Thương hiệu --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Thương hiệu</label>
                                <select name="MaThuongHieu" class="form-select" required>
                                    <option value="">-- Chọn thương hiệu --</option>
                                    @foreach ($thuongHieus as $th)
                                        <option value="{{ $th->MaThuongHieu }}"
                                            {{ old('MaThuongHieu') == $th->MaThuongHieu ? 'selected' : '' }}>
                                            {{ $th->TenThuongHieu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                                ⬅ Quay lại
                            </a>

                            <button type="submit" class="btn btn-primary px-4">
                                💾 Lưu sản phẩm
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
