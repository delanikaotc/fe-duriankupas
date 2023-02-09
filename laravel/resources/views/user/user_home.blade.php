{{-- script/kode untuk tampilan halaman profil user --}}

{{-- menggunakan user layout --}}
@extends('layouts.user_main')

{{-- isi konten yang akan dipanggil pada user layout --}}
@section('content')
<div class="content">
    {{-- alert menampilkan message success --}}
    @if (session()->has('success'))
    <div class="sub-content">
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    </div>
    @endif
    {{-- menampilkan alert error jika ada --}}
    @if ($errors->any())
    <div class="sub-content">
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    </div>
    @endif
    <div class="title-page">
        <h1 style="font-weight: 600">Profil</h1>
    </div>
    <div class="sub-content">
        <div class="row">
            @include('partials.sidebar_user')
            <div class="col">
                <div class="bg-user">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                {{-- menampilkan identitas diri --}}
                                <div style="font-weight:600; font-size: 16px">Identitas Diri</div>
                            </div>
                            <div class="row mb-2" style="font-weight:400; font-size:14px">
                                {{-- menampilkan nama --}}
                                <div class="col-4 mb-2">Nama</div>
                                <div class="col-8 mb-2" style="">{{ $data['username'] }}</div>
                            </div>
                            <div class="row mb-2" style="font-weight:400; font-size:14px">
                                {{-- menampilkan tanggal lahir jika nilai tidak NULL --}}
                                <div class="col-4 mb-2">Tanggal Lahir</div>
                                @if ($data['tanggallahir'] != NULL)
                                <div class="col-8 mb-2">{{ date_format(date_create($data['tanggallahir']), 'd M Y') }}</div>   
                                @else
                                <div></div>   
                                @endif
                            </div>
                            <div class="row mb-2" style="font-weight:400; font-size:14px">
                                {{-- menampilkan jenis kelamin --}}
                                <div class="col-4 mb-2">Jenis Kelamin</div>
                                <div class="col-8 mb-2">{{ $data['jeniskelamin'] }}</div>
                            </div>
                            {{-- menampilkan informasi kontak --}}
                            <div class="mb-3" style="font-weight:400; font-size:14px">
                                <div style="font-weight:600; font-size: 16px">Kontak</div>
                            </div>
                            <div class="row mb-2" style="font-weight:400; font-size:14px">
                                {{-- menampilkan email  --}}
                                <div class="col-4 mb-2">Email</div>
                                <div class="col-8" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $data['email'] }}</div>
                            </div>
                            <div class="row mb-4" style="font-weight:400; font-size:14px">
                                {{-- menampilkan nomor hp --}}
                                <div class="col-4 mb-2">Nomor HP</div>
                                <div class="col-8 mb-2">{{ $data['phone'] }}</div>
                            </div>
                            {{-- button mengarahkan ke ubah profil apabila diklik --}}
                            <div>
                                <a class="btn btn-primary" href="{{ route('editProfil', $data['_id']) }}" role="button" style="width:100px; margin-bottom:20px;">Ubah</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection