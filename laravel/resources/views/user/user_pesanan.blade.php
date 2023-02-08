{{-- script/kode untuk tampilan halaman daftar pesanan user --}}

{{-- menggunakan layout user --}}
@extends('layouts.user_main')

{{-- isi konten yang akan dipanggil di layout user --}}
@section('content')
<div class="content">
    <div class="title-page">
        <h1 style="font-weight: 600">Daftar Pesanan</h1>
    </div>
    {{-- menampilkan alert success jika terdapat message success --}}
    @if (session()->has('success'))
    <div class="sub-content">
        <div class="alert alert-success" role="alert">
            {{ session()->get('success') }}
        </div>
    </div>
    @endif
    <div class="sub-content">
        <div class="row">
            @include('partials.sidebar_user')
            <div class="col">
                <div class="bg-user">
                    {{-- <div class="row"> --}}
                        <div class="col mb-4">
                            <a class="btn btn-primary" href="{{ route('produkView') }}" role="button">Buat Pesanan Baru</a>
                        </div>
                        {{-- menampilkan setiap data pesanan yang sudah diambil berdasarkan id user --}}
                        <div class="row">
                            @foreach ($dataPesanan as $item)
                            @if ($item['status'] != 'Menunggu Konfirmasi')
                            <div class="col-lg-4 col-sm-12 col-md-6">
                                <div class="card-pesanan">
                                    <div class="mb-4">
                                        <div class="card-pesanan-title">Pesanan</div>
                                        <div>{{ date_format(date_create($item['createdAt']), 'd M Y, G:i') }}</div>
                                        @if ($item['status'] == 'Menunggu Pembayaran' || $item['status'] == 'Verifikasi Pembayaran' || $item['status'] == 'Menunggu Pengiriman' || $item['status'] == 'Sudah Dikirim')
                                        <div class="label-kuning">{{ $item['status'] }}</div> 
                                        @elseif ($item['status'] == 'Sudah Dikirim' || $item['status'] == 'Selesai' )
                                        <div class="label-hijau">{{ $item['status'] }}</div> 
                                        @elseif ($item['status'] == 'Pembayaran Ditolak')
                                        <div class="label-merah">{{ $item['status'] }}</div> 
                                        @endif
                                    </div>
                                    @foreach ($item['pesanan'] as $pesanan)
                                    <div>
                                        <div>{{ $pesanan['product'] }}(x{{ $pesanan['jumlah'] }})</div>
                                    </div>
                                    @endforeach
                                    <hr>
                                    <div class="row mb-4" style="font-weight: 600">
                                        <div class="col">Total Belanja</div>
                                        <div class="col d-flex justify-content-end">@currency($item['total'])</div>
                                    </div>
                                    <div>
                                        @if ($item['status'] == 'Selesai')
                                            @if ($item['review'] == false)
                                            <div>
                                                <a class="btn btn-primary mb-2" href="{{ route('beriUlasanView', $item['_id']) }}" role="button" style="font-size: 12px;">Beri Ulasan</a>              
                                            </div>
                                            @endif
                                        @elseif ($item['status'] == 'Menunggu Pembayaran')        
                                        <div>
                                            <a class="btn btn-primary mb-2" href="{{ route('pembayaranView', $item['_id']) }}" role="button" style="font-size: 12px;">Bayar Pesanan</a>     
                                        </div>
                                        @elseif ($item['status'] == 'Pembayaran Ditolak')
                                        <div>
                                            <a class="btn btn-primary mb-2" href="{{ route('pembayaranView', $item['_id']) }}" role="button" style="font-size: 12px;">Unggah Bukti Pembayaran</a>          
                                        </div>
                                        @elseif ($item['status'] == 'Sudah Dikirim')        
                                        <form action="{{ route('pesananSampai', $item['_id']) }}" method="post">
                                            {!! method_field('post') . csrf_field() !!}   
                                            <button class="btn btn-primary mb-2" type="submit" style="font-size: 12px;">
                                                Pesanan Sudah Sampai
                                            </button>  
                                        </form>                    
                                        @endif
                                        <div>
                                            <a class="btn btn-outline-primary" href="{{ route('rincianPesananView', $item['_id']) }}" role="button" style="font-size: 12px;">Rincian Pesanan</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection