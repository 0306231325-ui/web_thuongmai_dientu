@extends('layouts.app')

@section('content')
<div id="product-data"
     data-bienthes='@json($sanPham->bienThes->keyBy("MaBienThe"))'>
</div>

<div class="container mt-4">

    
    <div class="row">
        
     <div class="col-md-5">
    <div class="position-relative product-image-box">

        <button class="img-arrow left" id="btnPrev">‹</button>

        <img id="mainImage"
             src="{{ asset('img/hinhanhsanpham/' . $sanPham->hinhAnhChinh->DuongDan) }}"
             data-default-src="{{ asset('img/hinhanhsanpham/' . $sanPham->hinhAnhChinh->DuongDan) }}"
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

            <p>
                Thương hiệu:
                <strong>{{ $sanPham->thuongHieu->TenThuongHieu }}</strong>
            </p>

            <h4 class="text-danger" id="giaBan">
                {{ number_format($sanPham->bienThes->min('GiaBan')) }} ₫
            </h4>

            <p id="tonKho" class="fw-bold"></p>

            <hr>

            
            <h5>Chọn loại</h5>
            <div class="d-flex flex-wrap">
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
        </div>
    </div>


    <hr>
    <h5>Mô tả</h5>
    <p>{{ $sanPham->MoTaChiTiet }}</p>


   
    <hr>
    <h5>Đánh giá</h5>

    @php
        $avg = round($sanPham->danhGias->avg('SoSao'), 1);
    @endphp

    <p>Số Sao {{ $avg }}/5 ({{ $sanPham->danhGias->count() }} đánh giá)</p>

    @foreach($sanPham->danhGias as $dg)
        <div class="border-bottom mb-2 pb-2">
            <strong>{{ $dg->nguoiDung->HoTen }}</strong>
            <span class="text-warning">
                {{ str_repeat('★', $dg->SoSao) }}
            </span>
            <p>{{ $dg->NoiDung }}</p>
        </div>
    @endforeach

</div>
@endsection

@push('scripts')
<script src="{{ asset('js/product-detail.js') }}"></script>
@endpush


