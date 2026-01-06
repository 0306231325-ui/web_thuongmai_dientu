<div class="container-fluid">
    <div class="row align-items-center bg-light py-3 px-xl-5">
        <div class="col-lg-4 col-md-4 text-center text-lg-left mb-2 mb-lg-0">
            <a href="{{ url('/') }}">
                <img 
                    src="{{ asset('img/logo/lo_go.jpg') }}" 
                    alt="Badminton Shop"
                    style="height: 100px; width: auto;"
                >
            </a>
        </div>
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
        <div class="col-lg-4 col-md-4 text-center text-lg-right">
            <div class="btn-group">
                <button 
                    type="button" 
                    class="btn btn-outline-dark btn-sm dropdown-toggle" 
                    data-toggle="dropdown"
                >
                    My Account
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Sign in</a>
                    <a class="dropdown-item" href="#">Sign up</a>
                </div>
            </div>
        </div>

    </div>
</div>
