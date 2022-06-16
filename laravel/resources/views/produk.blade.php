@extends('layouts.main')

@section('content')
<div class="content">
    <div class="row">
        <div class="col">
            <h1 style="font-weight: 600">Produk Kami</h1>
        </div>
        <div class="col pt-1 ">
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
        </div>
    </div>
    <div class="sub-content row d-flex justify-content-center">
        @foreach ($dataProduk as $item)
        <div class="card-produk">
            <div>
                <img src="{{ $item['img'] }}" alt="" class="card-produk image">
            </div>
            <div class="card-produk title">
                {{ $item['nama'] }}
            </div>
            <div class="card-produk price">
                Rp{{ $item['harga'] }}
            </div>
            <form action="" method="post">
            {!! method_field('post') . csrf_field() !!}
                <div class="row d-flex justify-content-center">
                    <div class="input-group mb-3" style="width: 150px">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                        <input type="text" class="form-control" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" style="text-align: center;">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1">+</button>
                      </div>
                </div>
            </form>
        </div> 
        @endforeach
        @if (Cookie::get('roleUser') == 'reseller' || Cookie::get('roleUser') == 'admin')
        <div></div>
        @else
        <div class="row d-flex justify-content-center mt-3" style="margin-bottom:60px;">
            <a class="btn btn-primary me-3" href="/buat-pesanan" role="button" style="width: 300px">Buat Pesanan</a>
        </div>
        @endif
    </div>
</div>
@endsection

