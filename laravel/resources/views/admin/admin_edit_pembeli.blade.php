@extends('layouts.admin_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        @if ($errors->any())
        <div class="sub-content">
            <div class="alert alert-danger" role="alert" style="width: 12410px;">
                {{ $errors->first() }}
            </div>
        </div>
        @endif
        <div class="bg mb-4">
            <form action="{{ route('simpanEditPembeli', $data['_id']) }}" method="post">
            {!! method_field('post') . csrf_field() !!}
            <div class="col" style="text-align: left;">
                <div class="mb-3 row">
                    <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input name="username" readonly placeholder="Username" type="text" class="form-control" id="inputUsername" value="{{ $data['username'] }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputTL" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                    <div class="col-sm-10">
                        <input name="tanggallahir" placeholder="Tanggal Lahir" type="date" class="form-control" id="inputTL" value="{{ date_format(date_create($data['tanggallahir']), 'dd/MM/YYYY') }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="input" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                        <select id="jeniskelamin" name="jeniskelamin" class="form-select form-select-m" aria-label=".form-select-sm example">
                            @if ($data['jeniskelamin'] == 'Laki-laki')
                            <option selected value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                            @elseif ($data['jeniskelamin'] == 'Perempuan')
                            <option value="Laki-laki">Laki-laki</option>
                            <option selected value="Perempuan">Perempuan</option>
                            @else 
                            <option>Pilih Jenis Kelamin</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                            @endif
                        </select>                         
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input name="email" readonly placeholder="Email" type="text" class="form-control" id="inputEmail" value="{{ $data['email'] }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputPhone" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input name="phone" placeholder="Nomor Telepon" type="text" class="form-control" id="inputPhone" value="{{ $data['phone'] }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end" style="margin-left: -24px">
              <button type="submit" class="btn btn-primary">Simpan</button>    
            </div>
        </div>
    </form>
    </div>
</div>
    
@endsection