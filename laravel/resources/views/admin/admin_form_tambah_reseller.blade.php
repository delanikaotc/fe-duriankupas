@extends('layouts.admin_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        <div class="bg mb-4">
            <form action="{{ route('tambahReseller') }}" method="post">
            {!! method_field('post') . csrf_field() !!}
            <div style="text-align: left;">
                <div class="mb-3 row">
                    <label for="inputNamaToko" class="col-sm-2 col-form-label">Nama Toko</label>
                    <div class="col-sm-10">
                      <input name="namatoko" placeholder="Nama Toko" type="text" class="form-control" id="inputNamaToko">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputIdUser" class="col-sm-2 col-form-label">ID User</label>
                    <div class="col-sm-10">
                      <input name="id_user" placeholder="ID User" type="text" class="form-control" id="inputIdUser">
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input name="email" placeholder="Email" type="email" class="form-control" id="inputEmail">
                        </div>
                    </div>
                    <div class="col row">
                        <label for="inputPhone" class="col-sm-4 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-8">
                            <input name="phone" placeholder="Nomor Telepon" type="text" class="form-control" id="inputPhone">
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <div class="col row">
                        <label for="inputProvinsi" class="col-sm-4 col-form-label">Provinsi</label>
                        <div class="col-sm-8">
                            <input name="provinsi" placeholder="Provinsi" type="text" class="form-control" id="inputProvinsi">
                        </div>
                    </div>
                    <div class="col row">
                        <label for="inputKota" class="col-sm-4 col-form-label">Kota</label>
                        <div class="col-sm-8">
                            <input name="kota" placeholder="Kota" type="text" class="form-control" id="inputKota">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg mb-4">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Foto Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Request</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($dataProduk as $k => $item)
                <tr>
                    <th scope="row"><img class="foto-produk" src="{{ $item['img'] }}" alt=""></th>
                    <td>
                        <input style="text-align: center" name="ArrStock[{{ $k }}][product]" type="text" readonly class="form-control-plaintext" id="inputProduct" value="{{ $item['nama'] }}">
                    </td>
                    <td class="d-flex justify-content-center">
                        <div class="col-3">
                            <input name="ArrStock[{{ $k }}][jumlah]" style="text-align: center;" type="number" class="form-control" placeholder="Jumlah" aria-label="Example text with button addon" aria-describedby="button-addon1">       
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
              </table>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end" style="margin-left: -24px">
              <button type="submit" class="btn btn-primary">Tambah Reseller</button>    
            </div>
        </div>
    </form>
    </div>
</div>
    
@endsection