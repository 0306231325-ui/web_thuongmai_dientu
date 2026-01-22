@extends('layouts.app')

@section('title', 'Chúc mừng năm mới 2026')

@section('content')

<div style="text-align: center; padding-top: 50px;">

    <h1>CHÚC MỪNG NĂM MỚI 2026</h1>

    <br>

    <p>
        Kính gửi Quý khách hàng,<br>
        Nhân dịp xuân mới, Cao Thang Shop kính chúc bạn và gia đình:<br>
        <b>An Khang - Thịnh Vượng - Vạn Sự Như Ý</b>
    </p>

    <br><br>

    <a href="{{ url('/') }}">
        <button style="padding: 10px 20px; cursor: pointer;">Trang Chủ</button>
    </a>

</div>

@endsection