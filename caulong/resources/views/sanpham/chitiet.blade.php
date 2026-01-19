@extends('layouts.app')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">

<div id="product-data"
     data-bienthes='@json($sanPham->bienThes->keyBy("MaBienThe"))'>
</div>

<div class="container mt-4">

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <a href="{{ route('shop.index') }}"
       class="btn mb-3"
       style="background: linear-gradient(45deg, #ff6b6b, #ff4757); color: white;">
        ← Quay về
    </a>

    

    <div class="row">

        <div class="col-md-5">
            <div class="position-relative product-image-box">

                <button class="img-arrow left" id="btnPrev">‹</button>

                <img id="mainImage"
                     src="{{ asset('img/hinhanhsanpham/' . $sanPham->hinhAnhChinh->DuongDan) }}"
                     class="img-fluid border">

                <button class="img-arrow right" id="btnNext">›</button>

            </div>

            <div class="d-flex gap-2 mt-2">
                @foreach($sanPham->hinhAnhs as $index => $img)
                    <img src="{{ asset('img/hinhanhsanpham/' . $img->DuongDan) }}"
                         class="border thumb-img"
                         data-index="{{ $index }}"
                         style="width:70px; cursor:pointer">
                @endforeach
            </div>
        </div>

        
        <div class="col-md-7">
            <h3>{{ $sanPham->TenSanPham }}</h3>

<div class="d-flex align-items-center mb-2">
    <span>
        Thương hiệu: <strong>{{ $sanPham->thuongHieu->TenThuongHieu }}</strong>
    </span>
    <span class="mx-2">|</span>
   <span class="text-dark">
    <i class="fas fa-eye"></i> {{ number_format($sanPham->LuotXem) }} lượt xem
</span>
</div>

            <h4 class="text-danger" id="giaBan">
                {{ number_format($sanPham->bienThes->min('GiaBan')) }} ₫
            </h4>

            <p id="tonKho" class="fw-bold"></p>

            <hr>

            <h5>Chọn loại</h5>
            <div class="d-flex flex-wrap gap-2">
                @foreach($sanPham->bienThes as $bt)
                    <div class="variant-item"
                         data-id="{{ $bt->MaBienThe }}">
                        {{ $bt->TenBienThe }}
                    </div>
                @endforeach
            </div>

            <hr>

            
            <input type="number"
                   id="soLuong"
                   value="1"
                   min="1"
                   class="form-control w-25 mb-3">

            
            <button id="btnAddToCart"
                    class="btn btn-danger"
                    disabled>
                Thêm vào giỏ
            </button>

            <a class="btn btn-outline-danger"
            href="{{ route('yeuthich.store', $sanPham->MaSanPham) }}"
            title="Thêm vào yêu thích">
            <i class="far fa-heart"></i>
    </a>
        </div>
    </div>

    <hr>
    <h5>Mô tả</h5>
    <p>{{ $sanPham->MoTaChiTiet }}</p>
    <hr>

<h5>Đánh giá sản phẩm</h5>


<p>
     {{ number_format($sanPham->danhGias->avg('SoSao') ?? 0, 1) }}/5
    ({{ $sanPham->danhGias->count() }} đánh giá)
</p>


@forelse($sanPham->danhGias as $dg)
    <div class="border rounded p-2 mb-2">
        <strong>{{ $dg->nguoiDung->HoTen ?? 'Người dùng' }}</strong>
        <span class="text-warning ms-2">
            {{ str_repeat('★', $dg->SoSao) }}
        </span>
        <p class="mb-0">{{ $dg->BinhLuan }}</p>
    </div>
@empty
    <p class="text-muted">Chưa có đánh giá nào</p>
@endforelse


@auth
    <form action="{{ route('danhgia.store') }}" method="POST" class="mb-4">
        @csrf

        <input type="hidden" name="MaSanPham" value="{{ $sanPham->MaSanPham }}">

        <div class="mb-2">
            <label class="form-label fw-bold">Số sao</label>
            <select name="SoSao" class="form-select w-25" required>
                <option value="">-- Chọn --</option>
                @for($i = 5; $i >= 1; $i--)
                    <option value="{{ $i }}">{{ $i }} </option>
                @endfor
            </select>
        </div>

        <div class="mb-2">
            <label class="form-label fw-bold">Bình luận</label>
            <textarea name="BinhLuan"
                      class="form-control"
                      rows="3"
                      placeholder="Nhập cảm nhận của bạn..."
                      required></textarea>
        </div>

        <button class="btn btn-primary">Gửi đánh giá</button>
    </form>
@else
    <div class="alert alert-warning">
         <a href="{{ route('login') }}">Đăng nhập</a> để viết đánh giá sản phẩm
    </div>
@endauth
</div>
@endsection


