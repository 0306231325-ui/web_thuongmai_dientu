@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')

<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Liên hệ</span>
    </h2>
    <div class="row px-xl-5">
        <div class="col-lg-6 mb-4">
            <div class="contact-form bg-light p-30">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div id="success"></div>
                
                <form action="{{ route('lien-he.gui') }}" method="POST" name="sentMessage" id="contactForm" novalidate="novalidate">
                    @csrf  <div class="control-group mb-3">
                        <input type="text" class="form-control" name="ho_ten" placeholder="Họ và tên" required="required" 
                               value="{{ old('ho_ten') }}" /> @error('ho_ten') <p class="help-block text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="control-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email của bạn" required="required" 
                               value="{{ old('email') }}"/>
                        @error('email') <p class="help-block text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div class="control-group mb-3">
                        <input type="text" class="form-control" name="sdt" placeholder="Số điện thoại" 
                               value="{{ old('sdt') }}"/>
                    </div>

                    <div class="control-group mb-3">
                        <input type="text" class="form-control" name="tieu_de" placeholder="Tiêu đề" required="required" 
                               value="{{ old('tieu_de') }}"/>
                    </div>

                    <div class="control-group mb-3">
                        <textarea class="form-control" rows="8" name="noi_dung" placeholder="Nội dung lời nhắn" required="required">{{ old('noi_dung') }}</textarea>
                        @error('noi_dung') <p class="help-block text-danger">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit">Gửi Tin Nhắn</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="bg-light p-30 h-100">
                <p class="mb-4">
                    <i class="fa fa-map-marker-alt text-primary mr-3"></i>
                    65 Huỳnh Thúc Kháng, Phường Sài Gòn, Quận 1, TP.HCM
                </p>
                <p class="mb-4">
                    <i class="fa fa-envelope text-primary mr-3"></i>
                    vul53290@gmail.com
                </p>
                <p class="mb-0">
                    <i class="fa fa-phone-alt text-primary mr-3"></i>
                    0328 778 433
                </p>
            </div>
        </div>

    </div>
</div>

@endsection