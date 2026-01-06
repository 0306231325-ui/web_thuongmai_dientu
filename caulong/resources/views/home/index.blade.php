@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

{{-- Carousel --}}
@include('home.sections.carousel')

{{-- Featured --}}
@include('home.sections.featured')

{{-- Categories --}}
@include('home.sections.categories')

{{-- Products --}}
@include('home.sections.products')

@endsection
