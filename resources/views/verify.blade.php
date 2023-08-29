@extends('master')
@section('content')
<div class="wrapper">

    <div class="form-box verify">
        <h2>Verify</h2>
       
        <h1>Kích hoạt tài khoản</h1>

        <p>Xin chào {{ $user->name }},</p>

        <p>Cảm ơn bạn đã đăng ký tài khoản! Vui lòng nhấp vào liên kết bên dưới để kích hoạt tài khoản của bạn:</p>

        <a href="{{route('activate', $confirmation_code)}}">Kích hoạt tài khoản</a>

    </div>
</div>
@endsection
