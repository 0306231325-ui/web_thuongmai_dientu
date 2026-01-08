@extends('layouts.app')

@section('title', 'Sản phẩm yêu thích')

@section('content')

<div class="container-fluid">
    <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">Sản phẩm yêu thích</span>
    </h2>

    <div class="row px-xl-5">
        @forelse($wishlists as $item)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img
                        src="{{ asset('img/SanPham/' . $item->sanPham->HinhAnh) }}"
                        class="card-img-top"
                        style="height:200px; object-fit:cover;"
                    >

                    <div class="card-body text-center">
                        <h6 class="card-title">
                            {{ $item->sanPham->TenSanPham }}
                        </h6>

                        <a href="{{ route('product.show', $item->sanPham->MaSanPham) }}"
                           class="btn btn-sm btn-outline-primary">
                           Xem chi tiết
                        </a>

                        <form action="{{ route('yeuthich.delete', $item->MaYeuThich) }}"
                              method="POST"
                              class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                Xoá
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <p>Bạn chưa có sản phẩm yêu thích nào.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
