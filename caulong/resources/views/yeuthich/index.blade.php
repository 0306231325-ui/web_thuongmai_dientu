@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Sản phẩm yêu thích</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($wishlists->isEmpty())
        <div class="alert alert-info">Bạn chưa yêu thích sản phẩm nào.</div>
    @else
        <div class="row">
            @foreach($wishlists as $yt)
    <div class="col-md-3 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <h6>{{ $yt->sanPham->TenSanPham }}</h6>

                <p class="text-danger fw-bold">
                    {{ number_format($yt->sanPham->bienThes->min('GiaBan') ?? 0) }}đ
                </p>

                <a href="{{ route('sanpham.chitiet', $yt->sanPham->Slug) }}"
                   class="btn btn-warning btn-sm mb-2">
                    Xem sản phẩm
                </a>

                <form action="{{ route('yeuthich.destroy', $yt->MaYeuThich) }}"
                      method="POST"
                      class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-sm btn-danger"
                            onclick="return confirm('Xoá khỏi yêu thích?')">
                        Xoá
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach

        </div>
    @endif
</div>
@endsection
