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
            <form action="{{ route('simpanEditProduk', $dataProduk['_id']) }}" method="post" enctype="multipart/form-data">
            {!! method_field('post') . csrf_field() !!}
            <div class="row">
                <div class="col-4">
                    <img class="card-biodata-img" src="{{ $dataProduk['img'] }}" alt="">
                </div>
                <div class="col-8" style="text-align: left;">
                    <div class="mb-3 row">
                        <label for="inputNama" class="col-sm-4 col-form-label">Nama Produk</label>
                        <div class="col-sm-8">
                          <input name="nama" placeholder="Nama Produk" type="text" class="form-control" id="inputNamaProduk" value="{{ $dataProduk['nama'] }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputHarga" class="col-sm-4 col-form-label">Harga Produk</label>
                        <div class="col-sm-8">
                          <input name="harga" placeholder="Harga Produk" type="text" class="form-control" id="inputHargaProduk" value="{{ $dataProduk['harga'] }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputDeskripsi" class="col-sm-4 col-form-label">Deskripsi Produk</label>
                        <div class="col-sm-8">
                          <input name="deskripsi" placeholder="Deskripsi Produk" type="text" class="form-control" id="inputDeskripsiProduk" value="{{ $dataProduk['deskripsi'] }}">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputGambar" class="col-sm-4 col-form-label">Gambar Produk</label>
                        <div class="col-sm-8">
                            <input name="image" type="file" class="form-control-file" id="image">
                        </div>
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