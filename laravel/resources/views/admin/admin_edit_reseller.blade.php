@extends('layouts.admin_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        @if ($errors->any())
        <div class="sub-content">
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        </div>
        @endif
        <div class="bg mb-4">
            <form action="{{ route('simpanEditReseller', $data['tokonya']['_id']) }}" method="post">
            {!! method_field('post') . csrf_field() !!}
            <div class="col" style="text-align: left;">
                <div class="mb-3 row">
                    <label for="inputNamaToko" class="col-sm-2 col-form-label">Nama Toko</label>
                    <div class="col-sm-10">
                        <input name="namatoko" placeholder="Nama Toko" type="text" class="form-control" id="inputNamaToko" value="{{ $data['tokonya']['namatoko'] }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputNomorTelepon" class="col-sm-2 col-form-label">Nomor Telepon</label>
                    <div class="col-sm-10">
                        <input name="phone" placeholder="Nama Toko" type="text" class="form-control" id="inputNomorTelepon" value="{{ $data['tokonya']['phone'] }}">
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