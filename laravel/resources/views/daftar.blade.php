@extends('layouts.main')

@section('content')
<div class="content masuk" style="margin-bottom: 60px">
    <div class="title-page">
        <h1 style="font-weight: 600">Daftar</h1>
    </div>
    @if ($errors->any())
    <div class="sub-content">
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    </div>
    @endif
    <div class="sub-content">
        <div class="card-masuk">
            <form action="{{ route('daftar') }}" method="POST">
                {!! method_field('post') . csrf_field() !!}
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="inputNoTelp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon">
                </div>
                <div class="mb-4">
                    <label for="inputPassword" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi">
                </div>
                <div class="row d-flex justify-content-center mb-4" style="width:375px; margin-left: 0px">
                    <button type="submit" class="btn btn-primary">Daftar</button>    
                </div>
                <div style="margin-bottom:80px;">
                    <p style="text-align: center; font-weight: 400px; font-size: 14px">Dengan mendaftar, saya menyetujui <br>
                    Syarat dan Ketentuan serta Kebijakan Privasi</p>
                </div>
                <div class="sudah-punya-akun">
                    <p style="text-align: center; font-weight: 400px; font-size: 14px">Sudah punya akun? 
                        <a href="{{ route('masukView') }}">Masuk</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection