<div class="container-fluid">
    <div class="row align-items-center bg-light py-3 px-xl-5">

        <!-- Logo -->
        <div class="col-lg-4 col-md-4 text-center text-lg-left mb-2 mb-lg-0">
            <a href="{{ url('/') }}">
                <img 
                    src="{{ asset('img/logo/lo_go.jpg') }}" 
                    alt="Badminton Shop"
                    style="height: 100px; width: auto;"
                >
            </a>
        </div>

        <!-- Search -->
        <div class="col-lg-4 col-md-4 col-12 mb-2 mb-lg-0">
            <form>
                <div class="input-group">
                    <input 
                        type="text" 
                        class="form-control" 
                        placeholder="Search for products"
                    >
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent">
                            <i class="fa fa-search text-primary"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>

        <!-- My Account -->
<div class="col-lg-4 col-md-4 text-center text-lg-right">
    <div class="btn-group">
        <button 
            type="button" 
            class="btn btn-outline-dark btn-sm dropdown-toggle" 
            data-toggle="dropdown"
        >
            @guest
                My Account
            @else
                {{ Auth::user()->HoTen }} <!-- Hiển thị tên đăng nhập -->
            @endguest
        </button>

        <div class="dropdown-menu dropdown-menu-right">
            @guest
                <a class="dropdown-item" href="{{ route('login') }}">
                    Sign in
                </a>
                {{-- Nếu không dùng register, có thể xóa --}}
                <a class="dropdown-item" href="{{ route('register') }}">
                    Sign up
                </a>

            @else
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item" type="submit">
                        Logout
                    </button>
                </form>
            @endguest
        </div>
    </div>
</div>


    </div>
</div>
