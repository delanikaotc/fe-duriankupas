{{-- memnggil main layout --}}
@extends('layouts.main')

{{-- section konten  daftar yang dipanggil pada main layout --}}
@section('content')
<div class="content-daftar" style="margin-bottom: 60px">
    {{-- menampilkan alert --}}
    @if ($errors->any())
    <div class="sub-content">
        <div class="alert alert-danger" role="alert" style="width: 1248px;">
            {{ $errors->first() }}
        </div>
    </div>
    @endif
    {{-- judul halaman --}}
    <div class="title-page">
        <h1 style="font-weight: 600">Daftar</h1>
    </div>
    {{-- tampilan card masuk  --}}
    <div class="sub-content">
        <div class="card-masuk">
            {{-- sebuah form dengan method post, apabila disubmit akan diarahkan ke fungsi daftar
                untuk mengecek data yang diinput --}}
            <form action="{{ route('daftar') }}" method="POST">
                {!! method_field('post') . csrf_field() !!}
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{ old('username')}}">
                    <p style="color: #c4c4c4; font-size: 12px; font-weight: 400; text-decoration: none;">min. 8 karakter, hanya huruf dan angka</p>
                </div>
                <div class="mb-3">
                    <label for="inputEmail" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email')}}">
                </div>
                <div class="mb-3">
                    <label for="inputNoTelp" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nomor Telepon" value="{{ old('phone')}}">
                </div>
                <div class="mb-3">
                    <label for="inputPassword" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi">
                    <p style="color: #c4c4c4; font-size: 12px; font-weight: 400; text-decoration: none;">min. 8 karakter</p>
                </div>
                <div class="mb-4">
                    <label for="inputPassword" class="form-label">Ulangi Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password_confirmation" placeholder="Kata Sandi">
                </div>
                <div class="row d-flex justify-content-center mb-4" style="width:375px; margin-left: 0px">
                    <button type="submit" class="btn btn-primary">Daftar</button>    
                </div>
                <div style="margin-bottom:80px;">
                    <p style="text-align: center; font-weight: 400px; font-size: 14px">Dengan mendaftar, saya menyetujui <br>
                    Syarat dan Ketentuan serta Kebijakan Privasi</p>
                </div>
                {{-- diarahkan ke halaman masuk apabila sudah memiliki akun --}}
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