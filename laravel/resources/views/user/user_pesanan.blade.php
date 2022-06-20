@extends('layouts.user_main')

@section('content')
<div class="content">
    <div class="title-page">
        <h1 style="font-weight: 600">Daftar Pesanan</h1>
    </div>
    <div class="sub-content">
        <div class="row">
            @include('partials.sidebar_user')
            <div class="col">
                <div class="bg-user">
                    <div class="row">
                        <div class="col-6">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        <div class="col d-flex justify-content-end mb-4">
                            <a class="btn btn-primary" href="{{ route('produkView') }}" role="button" style="width: 200px">Buat Pesanan Baru</a>
                        </div>
                        <div class="row">
                            @foreach ($dataPesanan as $item)
                            @if ($item['status'] != 'Menunggu Konfirmasi')
                            <div class="card-pesanan">
                                <div class="mb-4">
                                    <div class="card-pesanan-title">Pesanan {{ $item['_id'] }}</div>
                                    <div>{{ $item['createdAt'] }}</div>
                                    <div>{{ $item['status'] }}</div>
                                </div>
                                @foreach ($item['pesanan'] as $pesanan)
                                <div>
                                    <div>{{ $pesanan['product'] }}(x{{ $pesanan['jumlah'] }})</div>
                                </div>
                                @endforeach
                                <hr>
                                <div class="row mb-4" style="font-weight: 600">
                                    <div class="col">Total Belanja</div>
                                    <div class="col d-flex justify-content-end">{{ $item['total'] }}</div>
                                </div>
                                <div>
                                    @if ($item['status'] == 'Selesai')
                                    <a class="btn btn-primary mb-2" href="{{ route('beriUlasanView', $item['_id']) }}" role="button" style="width: 227px; height: 30px; font-size: 12px;">Beri Ulasan</a>        
                                    @elseif ($item['status'] == 'Menunggu Pembayaran')        
                                    <a class="btn btn-primary mb-2" href="{{ route('pembayaranView', $item['_id']) }}" role="button" style="width: 227px; height: 30px; font-size: 12px;">Bayar Pesanan</a>                 
                                    @endif
                                    <a class="btn btn-outline-primary" href="/rincian-pesanan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Rincian Pesanan</a>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection