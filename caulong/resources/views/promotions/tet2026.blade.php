@extends('layouts.app') 

@section('title', 'Lời chúc Tết 2026')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">

<link href="{{ asset('css/chuctet.css') }}" rel="stylesheet">

<div class="tet-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-11">
                <div class="card tet-card text-center p-4 p-md-5">
                    
                    <h1 class="tet-title mb-4">Chúc Mừng Năm Mới 2026</h1>
                    
                    <div class="row align-items-center">
                        <div class="col-md-5 mb-4 mb-md-0">
                            <img src="/img/ChucTet/bannerchuctet.jpg" 
                                 alt="Happy New Year 2026" 
                                 class="img-fluid tet-image">
                        </div>
                        
                        <div class="col-md-7 text-md-start text-center ps-md-4">
                            <div class="tet-text mb-4">
                                <p class="mb-2">Kính gửi Quý khách hàng,</p>
                                <p>Nhân dịp xuân mới, <strong>Cao Thang Shop</strong> xin gửi tới bạn và gia đình lời chúc:</p>
                                <h3 class="my-3" style="color: #FFD700; font-family: 'Dancing Script', cursive;">An Khang - Thịnh Vượng - Vạn Sự Như Ý</h3>
                                <p>Cảm ơn bạn đã luôn tin tưởng và đồng hành cùng chúng tôi. Năm 2026 hứa hẹn sẽ mang đến nhiều niềm vui và thành công rực rỡ!</p>
                            </div>
                            
                            <div>
                                <a href="{{ url('/') }}" class="btn btn-lixi">
                                    <i class="fas fa-gift me-2"></i> Về Trang Chủ 
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection