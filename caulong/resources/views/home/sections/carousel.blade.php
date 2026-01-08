<div class="container-fluid mb-3">
    <div class="row px-xl-5">

        
        <div class="col-lg-8">
            <div id="header-carousel"
                 class="carousel slide carousel-fade mb-30 mb-lg-0"
                 data-ride="carousel">

                <ol class="carousel-indicators">
                    @foreach($slides as $index => $slide)
                        <li data-target="#header-carousel"
                            data-slide-to="{{ $index }}"
                            class="{{ $index === 0 ? 'active' : '' }}">
                        </li>
                    @endforeach
                </ol>

                <div class="carousel-inner">
                    @foreach($slides as $index => $slide)
                        <div class="carousel-item position-relative {{ $index === 0 ? 'active' : '' }}">
                            <img
                                src="{{ asset('img/Slideshow/' . $slide->HinhAnh) }}"
                                alt="{{ $slide->TieuDe }}"
                            >

                            <div class="carousel-caption">
                                <div class="carousel-content">
                                    @if($slide->TieuDe)
                                        <h2>{{ $slide->TieuDe }}</h2>
                                    @endif

                                    @if($slide->LienKet)
                                        <a href="{{ $slide->LienKet }}" class="btn btn-outline-light">
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

        
        <div class="col-lg-4 offer-wrapper">

            <div class="product-offer">
                <img src="{{ asset('img/spectialoffer/namconngua1.jpg') }}" alt="Thẻ giảm giá">
                <div class="offer-text">
                    <h6>Săn thẻ giảm giá lên tới 40%</h6>
                    <h3>Thẻ Giảm Giá</h3>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>

            <div class="product-offer">
                <img src="{{ asset('img/spectialoffer/namconngua2.jpg') }}" alt="Sửa chữa vợt">
                <div class="offer-text">
                    <h6>Giảm 10% nhân dịp Tết</h6>
                    <h3>Sửa Chữa Vợt</h3>
                    <a href="#" class="btn btn-primary">Xem chi tiết</a>
                </div>
            </div>

        </div>

    </div>
</div>
