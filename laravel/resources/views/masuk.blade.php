{{-- script/kode untuk tampilan masuk --}}

{{-- memanggil main layout --}}
@extends('layouts.main')

{{-- konten masuk yang akan dipanggil di main layout --}}
@section('content')
<div class="content-masuk" style="margin-bottom: 60px">
    {{-- menampilkan alert jika terdapat error --}}
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
          </div>
        @endif
        {{-- judul halaman --}}
    <div class="title-page">
        <h1 style="font-weight: 600">Masuk</h1>
    </div>
    <div class="sub-content">
        <div class="card-masuk">
            {{-- form dengan method post apabila disubmit akan menjalankan fungsi masuk yang akan mengecek data yang diinput --}}
            <form action="{{ route('masuk') }}" method="POST">
            {!! method_field('post') . csrf_field() !!}
                <div class="mb-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                </div>
                <div class="mb-4">
                    <label for="inputPassword" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Kata Sandi">
                    <a href="" class="d-flex justify-content-end" style="color: #212427; font-size: 14px; font-weight: 400; text-decoration: none;">Lupa kata sandi?</a>
                </div>
                <div class="row d-flex justify-content-center mb-4" style="margin-left: 0px; margin-right: 0px; margin-bottom:80px;">
                    <button type="submit" class="btn btn-primary">Masuk</button>                  
                </div>
                {{-- diarahkan ke halaman daftar apabila sudah memiliki akun --}}
                <div>
                    <p style="text-align: center; font-weight: 400; font-size: 14px;">Belum punya akun? 
                        <a href="{{ route('daftarView') }}">Daftar</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection