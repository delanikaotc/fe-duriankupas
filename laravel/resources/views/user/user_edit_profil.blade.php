@extends('layouts.user_main')

@section('content')
<div class="content">
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
                    <form action="{{ route('simpanEditProfil', $data['_id']) }}" method="post">
                        {!! method_field('post') . csrf_field() !!}
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
                                <div style="font-weight:400; font-size:14px">
                                    <div class="mb-3 row">
                                        <label for="inputUsername" class="col-sm-4 col-form-label">Username</label>
                                        <div class="col-sm-8">
                                        <input style="font-weight:400; font-size:14px" name="username" readonly placeholder="Username" type="text" class="form-control" value="{{ $data['username'] }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputTTL" class="col-sm-4 col-form-label">Tanggal Lahir</label>
                                        <div class="col-sm-8">
                                        <input style="font-weight:400; font-size:14px" type="date" name="tanggallahir" placeholder="Tanggal Lahir" type="text" class="form-control" id="inputTanggalLahir" value="">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputJK" class="col-sm-4 col-form-label">Jenis Kelamin</label>
                                        <div class="col-sm-8">
                                            <select id="jeniskelamin" name="jeniskelamin" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                                @if ($data['jeniskelamin'] == 'Laki-laki')
                                                <option selected value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                                @elseif ($data['jeniskelamin'] == 'Perempuan')
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option selected value="Perempuan">Perempuan</option>
                                                @else 
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="Laki-laki">Laki-laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                                @endif
                                            </select>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div style="font-weight:600; font-size: 16px">Kontak</div>
                                </div>
                                <div style="font-weight:400; font-size:14px">
                                    <div class="mb-3 row">
                                        <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                        <input style="font-weight:400; font-size:14px" readonly name="email" placeholder="Email" type="text" class="form-control" id="inputEmail" value="{{ $data['email'] }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="inputNoTelp" class="col-sm-4 col-form-label">Nomor HP</label>
                                        <div class="col-sm-8">
                                        <input style="font-weight:400; font-size:14px" name="phone" placeholder="Nomor Telepon" type="text" class="form-control" id="inputNoTelp" value="{{ $data['phone'] }}">
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <button type="submit" class="btn btn-primary" style="width:100px; margin-bottom:20px;">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection