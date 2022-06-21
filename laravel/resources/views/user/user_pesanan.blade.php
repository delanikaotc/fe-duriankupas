@extends('layouts.user_main')

@section('content')
<div class="content">
    @if (session()->has('success'))
            <div class="sub-content">
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            </div>
        @endif
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
                                        @if ($item['review'] == false)
                                            <a class="btn btn-primary mb-2" href="{{ route('beriUlasanView', $item['_id']) }}" role="button" style="width: 227px; height: 30px; font-size: 12px;">Beri Ulasan</a>              
                                        @endif
                                    @elseif ($item['status'] == 'Menunggu Pembayaran')        
                                    <a class="btn btn-primary mb-2" href="{{ route('pembayaranView', $item['_id']) }}" role="button" style="width: 227px; height: 30px; font-size: 12px;">Bayar Pesanan</a>     
                                    @elseif ($item['status'] == 'Sudah Dikirim')        
                                    <form action="{{ route('pesananSampai', $item['_id']) }}" method="post">
                                        {!! method_field('post') . csrf_field() !!}   
                                        <button class="btn btn-primary mb-2" type="submit" style="width: 227px; height: 30px; font-size: 12px;">
                                            Pesanan Sudah Sampai
                                        </button>  
                                    </form>                    
                                    @endif
                                    <a class="btn btn-outline-primary" href="{{ route('rincianPesananView', $item['_id']) }}" role="button" style="width: 227px; height: 30px; font-size: 12px;">Rincian Pesanan</a>
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