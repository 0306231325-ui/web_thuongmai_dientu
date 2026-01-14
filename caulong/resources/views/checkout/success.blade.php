@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <div class="card shadow-sm border-0" style="max-width: 600px; margin: 0 auto;">
        <div class="card-body p-5">
            <div class="text-success mb-3" style="font-size: 5rem;">
                <i class="bi bi-check-circle-fill"></i> </div>
            <h2 class="mb-3 text-success">Đặt hàng thành công!</h2>
            
            <p class="lead">Cảm ơn bạn đã mua hàng.</p>
            <hr>
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ url('/') }}" >

                    Về trang chủ
                </a>
            </div>
        </div>
    </div>
</div>
@endsection