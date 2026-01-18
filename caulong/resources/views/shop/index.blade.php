@extends('layouts.app')

@section('title', 'Shop Cầu Lông')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-4 mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif
<div class="container-fluid">
    <div class="row px-xl-5">

    
        
        <div class="col-lg-3 col-md-4">

            <div class="mb-3">
                <a href="{{ url('/') }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-arrow-left mr-1"></i> Quay lại trang chủ
                </a>
            </div>

            <h5 class="mb-4">Bộ lọc</h5>
            <form method="GET">
                <div class="form-group mb-3">
                    <label>Thương hiệu</label>
                    <select name="thuong_hieu" class="form-control" onchange="this.form.submit()">
                        <option value="all">Tất cả</option>
                        @foreach($thuongHieus as $th)
                            <option value="{{ $th->MaThuongHieu }}"
                                {{ request('thuong_hieu') == $th->MaThuongHieu ? 'selected' : '' }}>
                                {{ $th->TenThuongHieu }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label>Mức giá</label>
                    <select name="gia" class="form-control" onchange="this.form.submit()">
                        <option value="all">Tất cả</option>
                        <option value="0-500" {{ request('gia')=='0-500' ? 'selected' : '' }}>Dưới 500.000 ₫</option>
                        <option value="500-1000" {{ request('gia')=='500-1000' ? 'selected' : '' }}>500.000 – 1.000.000 ₫</option>
                        <option value="1000-2000" {{ request('gia')=='1000-2000' ? 'selected' : '' }}>1.000.000 – 2.000.000 ₫</option>
                        <option value="2000" {{ request('gia')=='2000' ? 'selected' : '' }}>Trên 2.000.000 ₫</option>
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label>Danh mục</label>
                    <select name="danh_muc" class="form-control" onchange="this.form.submit()">
                        <option value="all">Tất cả</option>
                        @foreach($danhMucs as $dm)
                            <option value="{{ $dm->MaDanhMuc }}"
                                {{ request('danh_muc') == $dm->MaDanhMuc ? 'selected' : '' }}>
                                {{ $dm->TenDanhMuc }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <a href="{{ route('shop.index') }}" class="btn btn-sm btn-secondary">Xóa bộ lọc</a>
            </form>
        </div>


        
        <div class="col-lg-9 col-md-8">
            
           

            <div class="row pb-3">
                @foreach($sanPhams as $sp)
                    @php
                        $giaMin = $sp->bienThes->min('GiaBan');
                        $tongTon = $sp->bienThes->sum('SoLuongTon');
                        $anh = $sp->hinhAnhChinh
                            ? asset('img/hinhanhsanpham/' . $sp->hinhAnhChinh->DuongDan)
                            : asset('img/no-image.png');
                    @endphp

                    <div class="col-lg-4 col-md-6 col-sm-6 pb-4">
                        <div class="product-item bg-light mb-4 h-100">

                            <div class="product-img position-relative overflow-hidden">
                                <a href="{{ route('sanpham.chitiet', $sp->Slug) }}">
                                    <img class="product-img-fixed" src="{{ $anh }}" alt="{{ $sp->TenSanPham }}">
                                </a>
                                <div class="product-action">
                                    <a class="btn btn-outline-dark btn-square"
                                       href="{{ route('sanpham.chitiet', $sp->Slug) }}">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>

                                    <a class="btn btn-outline-dark btn-square"
                                    href="{{ route('yeuthich.store', $sp->MaSanPham) }}">
                                    <i class="far fa-heart"></i>
                                </a>

                                    <a class="btn btn-outline-dark btn-square"
                                       href="{{ route('sanpham.chitiet', $sp->Slug) }}">
                                        <i class="fa fa-search"></i>
                                    </a>
                                </div>
                            </div>

                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate d-block px-2"
                                   href="{{ route('sanpham.chitiet', $sp->Slug) }}">
                                    {{ $sp->TenSanPham }}
                                </a>

                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5 class="mb-0">{{ number_format($giaMin, 0, ',', '.') }} ₫</h5>
                                </div>

                                <small class="text-muted d-block mt-1">{{ $sp->thuongHieu->TenThuongHieu }}</small>

                                <div class="mt-2">
                                    @if($tongTon > 0)
                                        <span class="badge badge-success">Còn hàng</span>
                                    @else
                                        <span class="badge badge-danger">Hết hàng</span>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach


                <div class="col-12 d-flex justify-content-center mt-4">
                    {{ $sanPhams->withQueryString()->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
