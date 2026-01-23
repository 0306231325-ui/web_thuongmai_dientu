@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-xl-5" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
@endif

@include('home.sections.carousel')

@include('home.sections.featured')

@include('home.sections.categories')

@include('home.sections.products')

@endsection
