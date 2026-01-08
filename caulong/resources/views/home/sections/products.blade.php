<div class="container-fluid pt-5 pb-3">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Sản Phẩm </span>
    </h2>

    <div class="row px-xl-5">
        @foreach($products as $sp)
            @php
                $bienThe = $sp->bienThes->first();
                $tongDanhGia = $sp->danhGias->count();
                $diemTrungBinh = $tongDanhGia > 0
                    ? round($sp->danhGias->avg('SoSao'), 1)
                    : 0;
            @endphp

            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4 h-100 d-flex flex-column">

                    
                    <div class="product-img position-relative overflow-hidden d-flex align-items-center justify-content-center"
                         style="height: 260px; background: #fff;">
                        <img
                            src="{{ asset('img/SanPham/' . $sp->HinhAnh) }}"
                            alt="{{ $sp->TenSanPham }}"
                            style="max-width:100%; max-height:100%; object-fit:contain;"
                        >

                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="#">
                                <i class="fa fa-shopping-cart"></i>
                            </a>
                            <a class="btn btn-outline-dark btn-square" href="#">
                                <i class="far fa-heart"></i>
                            </a>
                            <a class="btn btn-outline-dark btn-square" href="#">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>

                   
                    <div class="product-info text-center px-2 py-3 flex-grow-1 d-flex flex-column justify-content-between">

                        
                        <div class="product-info-top">
                            <a href="#" class="product-title-link">
                                <div class="product-title-wrapper">
                                    <span class="product-title-text">
                                        {{ $sp->TenSanPham }}
                                        @if(!empty($bienThe->TenBienThe))
                                            | <strong>{{ $bienThe->TenBienThe }}</strong>
                                        @endif
                                    </span>
                                </div>
                            </a>
                        </div>

                        
                        <div class="product-info-bottom mt-2">

                            <h5 class="mb-1">
                                {{ number_format($bienThe->GiaBan ?? 0) }} đ
                            </h5>

                            <div class="d-flex align-items-center justify-content-center">
                                
                                @for($i = 1; $i <= floor($diemTrungBinh); $i++)
                                    <small class="fa fa-star text-primary mr-1"></small>
                                @endfor

                                
                                @for($i = floor($diemTrungBinh) + 1; $i <= 5; $i++)
                                    <small class="fa fa-star text-muted mr-1"></small>
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
