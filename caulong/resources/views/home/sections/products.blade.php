<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Sản Phẩm Mới Nhất</span>
    </h2>

    <div class="row px-xl-5">
        @foreach($products as $sp)
            @php
                $bienThe = $sp->bienThes->first();

                $tongDanhGia = $sp->danhGias->count();
                $diemTrungBinh = $tongDanhGia > 0
                    ? round($sp->danhGias->avg('SoSao'), 1)
                    : 0;

                
                $anh = $sp->hinhAnhChinh
                    ? asset('img/hinhanhsanpham/' . $sp->hinhAnhChinh->DuongDan)
                    : asset('img/no-image.png');
            @endphp

            <div class="col-lg-3 col-md-4 col-sm-6 pb-4">
                <div class="product-item bg-light h-100 d-flex flex-column">

                   
                    <div class="product-img-fixed">
                        <img
                            src="{{ $anh }}"
                            alt="{{ $sp->TenSanPham }}"
                        >

                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="{{ route('sanpham.chitiet', $sp->Slug) }}">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            <a class="btn btn-outline-dark btn-square" href="#">
                                <i class="far fa-heart"></i>
                            </a>
                            <a class="btn btn-outline-dark btn-square" 
                            href="{{ route('shop.index', ['q' => $sp->TenSanPham]) }}">
                                <i class="fa fa-search"></i>
                            </a>

                            
                        </div>
                    </div>

                    
                    <div class="product-info text-center px-2 py-3 d-flex flex-column justify-content-between flex-grow-1">

                        
                        <div class="product-info-top">
                            <a href="{{ route('sanpham.chitiet', $sp->Slug) }}" class="product-title-link">
                                <span class="product-title-text">
                                    {{ $sp->TenSanPham }}
                                    @if(!empty($bienThe?->TenBienThe))
                                        | <strong>{{ $bienThe->TenBienThe }}</strong>
                                    @endif
                                </span>
                            </a>
                        </div>

                       
                        <div class="product-info-bottom mt-2">

                            <h5 class="mb-1 text-danger">
                                {{ number_format($bienThe->GiaBan ?? 0) }} đ
                            </h5>

                            <div class="d-flex align-items-center justify-content-center">
                                @for($i = 1; $i <= 5; $i++)
                                    <small class="fa fa-star {{ $i <= floor($diemTrungBinh) ? 'text-primary' : 'text-muted' }} mr-1"></small>
                                @endfor

                                <small class="ml-1">
                                    ({{ $tongDanhGia }} đánh giá)
                                </small>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        @endforeach
    </div>
</div>
