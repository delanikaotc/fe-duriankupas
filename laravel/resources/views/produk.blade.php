@extends('layouts.main')

@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <h1 style="font-weight: 600">Produk Kami</h1>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $errors->first() }}
    </div>
    @endif
    <form action="{{ route('buatPesanan') }}" method="post">
    {!! method_field('post') . csrf_field() !!}
    <div class="sub-content row d-flex justify-content-center">
        @foreach ($dataProduk as $k => $item)
        <div class="card-produk">
            <div>
                <img src="{{ $item['img'] }}" alt="" class="card-produk image">
            </div>
            <div class="card-produk title">
                {{ $item['nama'] }}
                <input type="hidden" name="ArrPesanan[{{ $k }}][product]" style="text-align: center;" type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $item['nama'] }}"> 
            </div>
            <div class="card-produk price">
                @currency($item['harga'])
            </div>
            @if (Cookie::get('roleUser') == 'reseller' || Cookie::get('roleUser') == 'admin' )
            <div></div>
            @else
                <div class="row d-flex justify-content-center">
                    <div class="input-group mb-3" style="width: 150px">
                        {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button> --}}
                        <input min="1" name="ArrPesanan[{{ $k }}][jumlah]" type="number" class="form-control" placeholder="Jumlah" aria-label="Example text with button addon" aria-describedby="button-addon1" style="text-align: center;">
                        {{-- <button class="btn btn-outline-secondary" type="button" id="button-addon1">+</button> --}}
                      </div>
                </div>
            @endif
        </div> 
        @endforeach
        @if (Cookie::get('roleUser') == 'reseller')
        <div class="d-flex justify-content-center">   
            <a href="{{ route('resellerDataPemesananBaruView')}}" class="btn btn-primary">Lihat Data Pemesanan</a>
        </div>
        @elseif (Cookie::get('roleUser') == 'admin')
        <div class="d-flex justify-content-center">   
            <a href="{{ route('adminDataProdukView')}}" class="btn btn-primary">Edit Data Produk</a>
        </div>
        @else
            @if (!empty(Cookie::get('accessToken')))
            <div class="row mt-3" style="margin-bottom:60px;">
                <div class="d-flex justify-content-center">            
                    <button type="submit" class="btn btn-primary" style="width: 300px">Buat Pesanan</button>    
                </div>
                {{-- <a class="btn btn-primary me-3" href="/buat-pesanan" role="button" style="width: 300px">Buat Pesanan</a> --}}
            </div>
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

