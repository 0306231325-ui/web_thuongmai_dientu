<div class="container-fluid bg-dark mb-3">
    <div class="row px-xl-5 align-items-center">

        
        <div class="col-lg-3 d-none d-lg-block">
            <a
                class="btn d-flex align-items-center justify-content-between bg-warning text-dark w-100"
                data-toggle="collapse"
                href="#navbar-vertical"
                style="height: 56px; padding: 0 20px;"
            >
                <span>
                    <i class="fa fa-bars mr-2"></i>Danh mục
                </span>
                <i class="fa fa-angle-down"></i>
            </a>

            <nav
                class="collapse position-absolute navbar navbar-vertical navbar-light bg-light p-0"
                id="navbar-vertical"
                style="width: calc(100% - 30px); z-index: 999;"
            >
                <div class="navbar-nav w-100">
                    <a href="#" class="nav-item nav-link">Vợt cầu lông</a>
                    <a href="#" class="nav-item nav-link">Giày cầu lông</a>
                    <a href="#" class="nav-item nav-link">Áo quần thể thao</a>
                    <a href="#" class="nav-item nav-link">Phụ kiện</a>
                </div>
            </nav>
        </div>

        
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-0" style="height:56px;">

                <div class="collapse navbar-collapse show align-items-center">
                    
                    
                    <div class="navbar-nav mr-auto">
                        <a href="{{ url('/') }}" class="nav-item nav-link">Trang chủ</a>
                        <a href="{{ route('shop.index') }}" class="nav-item nav-link">Sản phẩm</a>
                        <a href="{{ route('contact') }}" class="nav-item nav-link">Liên hệ</a>
                        <a href="#" class="nav-item nav-link">Hỗ trợ</a>
                        <a href="{{ route('yeuthich.index') }}" class="nav-item nav-link"> Yêu Thích</a>
                    </div>

                    
                    <div class="navbar-nav ml-auto">
                        <a href="#" class="nav-item nav-link d-flex align-items-center">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="badge badge-light ml-2">0</span>
                        </a>
                    </div>

                </div>
            </nav>
        </div>

    </div>
</div>
