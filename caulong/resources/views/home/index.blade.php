@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

@include('home.sections.carousel')

@include('home.sections.featured')

@include('home.sections.categories')

@include('home.sections.products')

@endsection
