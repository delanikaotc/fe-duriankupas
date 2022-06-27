@extends('layouts.user_main')

@section('content')
<div class="content">
    @if (session()->has('success'))
    <div class="sub-content">
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    </div>
    @endif
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
                        {{-- <div class="col-4">
                            <div class="card-biodata">
                                <img class="card-biodata-img" src="https://i.ibb.co/PxPg9Jy/person-icon.png" alt="">
                                <div>
                                    <a class="btn btn-outline-secondary" href="/" role="button" style="width:200px; margin-bottom:20px;">Ganti Foto</a>
                                </div>
                                <div style="font-width:300; font-size:10px">
                                    Besar file: maksimum 10.000.000 bytes (10 Megabytes). Ekstensi file yang diperbolehkan: .JPG .JPEG .PNG
                                </div>
                            </div>
                        </div> --}}
                        <div class="col">
                            <div class="mb-3">
                                <div style="font-weight:600; font-size: 16px">Identitas Diri</div>
                            </div>
                            <div class="row mb-2" style="font-weight:400; font-size:14px">
                                <div class="col-4 mb-2">Nama</div>
                                <div class="col-4 mb-2">{{ $data['username'] }}</div>
                            </div>
                            <div class="row mb-2" style="font-weight:400; font-size:14px">
                                <div class="col-4 mb-2">Tanggal Lahir</div>
                                @if ($data['tanggallahir'] != NULL)
                                <div class="col-4 mb-2">{{ date_format(date_create($data['tanggallahir']), 'd M Y') }}</div>   
                                @else
                                <div></div>   
                                @endif
                            </div>
                            <div class="row mb-2" style="font-weight:400; font-size:14px">
                                <div class="col-4 mb-2">Jenis Kelamin</div>
                                <div class="col-4 mb-2">{{ $data['jeniskelamin'] }}</div>
                            </div>
                            <div class="mb-3" style="font-weight:400; font-size:14px">
                                <div style="font-weight:600; font-size: 16px">Kontak</div>
                            </div>
                            <div class="row mb-2" style="font-weight:400; font-size:14px">
                                <div class="col-4 mb-2">Email</div>
                                <div class="col-4">{{ $data['email'] }}</div>
                            </div>
                            <div class="row mb-4" style="font-weight:400; font-size:14px">
                                <div class="col-4 mb-2">Nomor HP</div>
                                <div class="col-4 mb-2">{{ $data['phone'] }}</div>
                            </div>
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