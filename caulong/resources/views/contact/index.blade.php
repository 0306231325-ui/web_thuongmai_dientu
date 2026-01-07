@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')

{{-- Breadcrumb --}}
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('home') }}">Trang chủ</a>
                <span class="breadcrumb-item active">Liên hệ</span>
            </nav>
        </div>
    </div>
</div>

{{-- Contact --}}
<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Liên hệ</span>
    </h2>

    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="bg-light p-30">
                <form>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Họ tên">
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Tiêu đề">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" rows="6" placeholder="Nội dung"></textarea>
                    </div>
                    <button class="btn btn-primary">Gửi liên hệ</button>
                </form>
            </div>
        </div>

        <div class="col-lg-5 mb-5">
            <div class="bg-light p-30 mb-3">
                <p><i class="fa fa-map-marker-alt text-primary mr-3"></i>TP.HCM</p>
                <p><i class="fa fa-envelope text-primary mr-3"></i>contact@gmail.com</p>
                <p><i class="fa fa-phone-alt text-primary mr-3"></i>0123 456 789</p>
            </div>
        </div>
    </div>
</div>

@endsection
