{{-- script/kode untuk halaman produk kami yang bertujuan untuk menampilkan produk yang dijual dan menginputkan 
    jumlah pesanan sebagai langkah awal membuat pesanan --}}

{{-- menggunakan main layout --}}
@extends('layouts.main')

{{-- isi konten untuk produk --}}
@section('content')
<div class="content">
    <div class="row">
        {{-- judul halaman --}}
        <div class="col">
            <h1 style="font-weight: 600">Produk Kami</h1>
        </div>
    </div>
    {{-- menampilkan error apabila ada --}}
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first() }}
    </div>
    @endif
    {{-- form yang apabila disubmit akan menjalankan fungsi buat pesanan dengan metode post --}}
    <form action="{{ route('buatPesanan') }}" method="post">
    {!! method_field('post') . csrf_field() !!}
    <div class="sub-content row d-flex justify-content-center">
        {{-- menampilkan data produk setiap ada data produk yang diambil dari API --}}
        @foreach ($dataProduk as $k => $item)
        <div class="col-lg-3 col-md-12 col-sm-12 card-produk">
            <div>
                {{-- gambar produk --}}
                <img src="{{ $item['img'] }}" alt="" class="card-produk-image">
            </div>
            <div class="card-produk-title">
                {{-- nama produk --}}
                {{ $item['nama'] }}
                {{-- input hidden untuk assign nama produk untuk database pesanan --}}
                <input type="hidden" name="ArrPesanan[{{ $k }}][product]" style="text-align: center;" type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $item['nama'] }}"> 
            </div>
            <div class="card-produk-price">
                {{-- menampilkan harga dengan rupiah --}}
                @currency($item['harga'])
            </div>

            {{-- mengecek apabila rolenya reseller atau admin, tidak bisa menginput jumlah --}}
            @if (Cookie::get('roleUser') == 'reseller' || Cookie::get('roleUser') == 'admin' )
            <div></div>
            @else
                <div class="row d-flex justify-content-center">
                    <div class="input-group mb-3" style="width: 150px">
                        <input min="1" name="ArrPesanan[{{ $k }}][jumlah]" type="number" class="form-control" placeholder="Jumlah" aria-label="Example text with button addon" aria-describedby="button-addon1" style="text-align: center;">
                      </div>
                </div>
            @endif
        </div> 
        @endforeach

        {{-- mengecek kalau reseller buttonnya diarahkan untuk lihat data pemesanan --}}
        @if (Cookie::get('roleUser') == 'reseller')
        <div class="d-flex justify-content-center">   
            <a href="{{ route('resellerDataPemesananBaruView')}}" class="btn btn-primary">Lihat Data Pemesanan</a>
        </div>
        {{-- mengecek kalau admin buttonnya diarahkan untuk mengedit data produk --}}
        @elseif (Cookie::get('roleUser') == 'admin')
        <div class="d-flex justify-content-center">   
            <a href="{{ route('adminDataProdukView')}}" class="btn btn-primary">Edit Data Produk</a>
        </div> 
        @else
        {{-- mengecek jika role user dan memiliki accesstoken boleh melanjutkan pesanan --}}
            @if (!empty(Cookie::get('accessToken')))
            <div class="row mt-3" style="margin-bottom:60px;">
                <div class="d-flex justify-content-center">            
                    <button type="submit" class="btn btn-primary" style="width: 300px">Buat Pesanan</button>    
                </div>
                {{-- <a class="btn btn-primary me-3" href="/buat-pesanan" role="button" style="width: 300px">Buat Pesanan</a> --}}
            </div>
            {{-- mengecek jika tidak memiliki token diarahkan untuk login terlebih dahulu --}}
            @else
            <div class="d-flex justify-content-center">   
                <a href="{{ route('masukView')}}" class="btn btn-primary">Masuk untuk Pesan</a>
            </div>
            @endif
        @endif
        </form>
    </div>
</div>
@endsection

