<div class="container-fluid mb-3">
    <div class="row px-xl-5">

        
        <div class="col-lg-8">
            <div id="header-carousel"
                 class="carousel slide carousel-fade mb-30 mb-lg-0"
                 data-ride="carousel">

                
                <ol class="carousel-indicators">
                    @foreach($slides as $index => $slide)
                        <li
                            data-target="#header-carousel"
                            data-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}">
                        </li>
                    @endforeach
                </ol>

                
                <div class="carousel-inner">
                    @foreach($slides as $index => $slide)
                        <div class="carousel-item position-relative {{ $index === 0 ? 'active' : '' }}"
                             style="height: 430px;">

                            <img
                                class="position-absolute w-100 h-100"
                                src="{{ asset('img/Slideshow/' . $slide->HinhAnh) }}"
                                alt="{{ $slide->TieuDe }}"
                                style="object-fit: cover;"
                            >

                            <div class="carousel-caption d-flex align-items-center justify-content-center">
                                <div class="p-3 text-center" style="max-width: 700px;">

                                    @if($slide->TieuDe)
                                        <h2 class="text-white text-uppercase font-weight-bold mb-3 animate__animated animate__fadeInDown"
                                            style="font-size: 2.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,.5);">
                                            {{ $slide->TieuDe }}
                                        </h2>
                                    @endif

                                    @if($slide->LienKet)
                                        <a href="{{ $slide->LienKet }}"
                                           class="btn btn-outline-light py-2 px-4 animate__animated animate__fadeInUp">
                                            Xem ngay
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>

        
        <div class="col-lg-4">

            
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid"
                     src="{{ asset('img/spectialoffer/namconngua1.jpg') }}"
                     alt="Thẻ giảm giá">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Săn thẻ giảm giá lên tới 40%</h6>
                    <h3 class="text-white mb-3">Thẻ Giảm Giá</h3>
                    <a href="#" class="btn btn-primary">Xem Chi Tiết</a>
                </div>
            </div>

            
            <div class="product-offer mb-30" style="height: 200px;">
                <img class="img-fluid"
                     src="{{ asset('img/spectialoffer/namconngua2.jpg') }}"
                     alt="Sửa chữa vợt">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Giảm 10% nhân dịp Tết</h6>
                    <h3 class="text-white mb-3">Sửa Chữa Vợt</h3>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>

        </div>

    </div>
</div>
