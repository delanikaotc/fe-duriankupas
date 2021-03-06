{{-- script/kode untuk tampilan form tambah reseller --}}

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
            {{-- form untuk input data reseller baru dan akan dijalankan fungsi tambahReseller ketika admin menekan button tambah reseller --}}
            <form action="{{ route('tambahReseller') }}" method="post">
            {!! method_field('post') . csrf_field() !!}
            <div style="text-align: left;">
                <div class="mb-3 row">
                    {{-- nama toko --}}
                    <label for="inputNamaToko" class="col-sm-2 col-form-label">Nama Toko</label>
                    <div class="col-sm-10">
                      <input name="namatoko" placeholder="Nama Toko" type="text" class="form-control" id="inputNamaToko">
                    </div>
                </div>
                <div class="mb-3 row">
                    {{-- username --}}
                    <label for="inputIdUser" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                      <input name="username" placeholder="Username" type="text" class="form-control" id="inputUsername">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col row">
                        {{-- provinsi --}}
                        <label for="inputProvinsi" class="col-sm-4 col-form-label">Provinsi</label>
                        <div class="col-sm-8">
                            <input name="provinsi" placeholder="Provinsi" type="text" class="form-control" id="inputProvinsi">
                        </div>
                    </div>
                    <div class="col row">
                        {{-- kabupaten/kota --}}
                        <label for="inputKota" class="col-sm-4 col-form-label">Kabupaten/Kota</label>
                        <div class="col-sm-8">
                            <input name="kota" placeholder="Kota" type="text" class="form-control" id="inputKota">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg mb-4">
            {{-- inputan untuk produk dan jumlah awal reseller --}}
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Foto Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Produk</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($dataProduk as $k => $item)
                <tr>
                    <th scope="row"><img class="foto-produk" src="{{ $item['img'] }}" alt=""></th>
                    <td>
                        {{ $item['nama'] }}
                        <input type="hidden" style="text-align: center" name="ArrStock[{{ $k }}][product]" type="text" readonly class="form-control-plaintext" id="inputProduct" value="{{ $item['nama'] }}">
                    </td>
                    <td class="d-flex justify-content-center">
                        <div class="col-3">
                            <input min="1" name="ArrStock[{{ $k }}][jumlah]" style="text-align: center;" type="number" class="form-control" placeholder="Jumlah" aria-label="Example text with button addon" aria-describedby="button-addon1">       
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
              </table>
        </div>
        {{-- button submit untuk mengirimkan data baru reseller --}}
        <div class="row">
            <div class="col d-flex justify-content-end" style="margin-left: -24px">
              <button type="submit" class="btn btn-primary">Tambah Reseller</button>    
            </div>
        </div>
    </form>
    </div>
</div>
    
@endsection