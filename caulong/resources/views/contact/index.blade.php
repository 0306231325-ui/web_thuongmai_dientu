@extends('layouts.app')

@section('title', 'Liên hệ')

@section('content')



<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Liên hệ</span>
    </h2>

    <div class="row px-xl-5">

       
        <div class="col-lg-6 mb-4">
            <div class="bg-light p-3 h-100">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.513933997974!2d106.69867477594718!3d10.771894089376614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f40a3b49e59%3A0xa1bd14e483a602db!2zVHLGsOG7nW5nIENhbyDEkeG6s25nIEvhu7kgdGh14bqtdCBDYW8gVGjhuq9uZw!5e0!3m2!1svi!2s!4v1767799146693!5m2!1svi!2s"
                    style="width:100%; height:300px; border:0;"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
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
