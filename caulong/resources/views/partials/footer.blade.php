<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <div class="mb-4">
                <a href="{{ url('/') }}">
                    <img 
                        src="{{ asset('img/logo/lo_go.jpg') }}" 
                        alt="Badminton Shop"
                        style="height: 100px; width: auto;"
                    >
                </a>
            </div>
            
            <p class="mb-4">Shop cầu lông uy tín - Chất lượng hàng đầu Việt Nam . Nơi đam mê tỏa sáng cùng những cú đập cầu uy lực.</p>
            
            <h5 class="text-secondary text-uppercase mb-4">Liên Hệ</h5>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>29 Chấn Hưng, P6, Quận Tân Bình</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>vul53290@gmail.com</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>0328778433</p>
        </div>

        <div class="col-lg-8 col-md-12">
            <div class="row">
                
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Danh Mục Chính</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ url('/') }}">
                            <i class="fa fa-angle-right mr-2"></i>Trang chủ
                        </a>
                        <a class="text-secondary mb-2" href="{{ route('shop.index') }}">
                            <i class="fa fa-angle-right mr-2"></i>Sản phẩm
                        </a>
                        <a class="text-secondary mb-2" href="{{ route('contact') }}">
                            <i class="fa fa-angle-right mr-2"></i>Liên hệ
                        </a>
                    </div>
                </div>

                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Hỗ Trợ Khách Hàng</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('yeuthich.index') }}">
                            <i class="fa fa-angle-right mr-2"></i>Yêu Thích
                        </a>
                        <a class="text-secondary mb-2" href="{{ route('gio-hang') }}">
                            <i class="fa fa-angle-right mr-2"></i>Giỏ Hàng
                        </a>
                        <a class="text-secondary" href="#">
                            <i class="fa fa-angle-right mr-2"></i>Hỗ trợ & Tư vấn
                        </a>
                    </div>
                </div>

                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Bảng Tin Mới</h5>
                    <p>CHIA SẺ SHOP BÁN VỢT NÀY VỚI GROUP CAOTHANG VÀ MN NÀO</p>
                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Theo Dõi Chúng Tôi</h6>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square mr-2" href="https://x.com/"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="https://www.facebook.com/vu.thien.phu.242307"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="https://www.linkedin.com/in/ph%C3%BA-v%C5%A9-thi%C3%AAn-9b724b397/"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-square" href="https://www.instagram.com/thienphu_140905/"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-6 px-xl-0">
          
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right">
            <img class="img-fluid" src="{{ asset('img/payments.png') }}" alt="">
        </div>
    </div>
</div>