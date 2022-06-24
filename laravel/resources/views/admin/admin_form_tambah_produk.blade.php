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
            <form action="{{ route('tambahProduk') }}" method="post" enctype="multipart/form-data">
            {!! method_field('post') . csrf_field() !!}
            <div style="text-align: left;">
                <div class="mb-3 row">
                    <div class="col row">
                        <label for="inputNamaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                        <div class="col-sm-8">
                            <input name="nama" placeholder="Nama Produk" type="text" class="form-control" id="inputNamaProduk">
                        </div>
                    </div>
                    <div class="col row">
                        <label for="inputHarga" class="col-sm-4 col-form-label">Harga Produk</label>
                        <div class="col-sm-8">
                            <input name="harga" placeholder="Harga" type="text" class="form-control" id="inputHarga">
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi Produk</label>
                    <div class="col-sm-10">
                      <input name="deskripsi" placeholder="Deskripsi Produk" type="text" class="form-control" id="inputDeskripsiProduk">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="inputGambar" class="col-sm-2 col-form-label">Gambar Produk</label>
                    <div class="col-sm-10">
                        <input name="image" type="file" class="form-control-file" id="inputBuktiPembayaran">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex justify-content-end" style="margin-left: -24px">
              <button type="submit" class="btn btn-primary">Tambah Produk</button>    
            </div>
        </div>
    </form>
    </div>
</div>
    
@endsection