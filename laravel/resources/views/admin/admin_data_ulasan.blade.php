{{-- script/kode untuk tampilan data ulasan --}}

@extends('layouts.admin_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        <div class="row justify-content-end mb-5">
            <form class="col-4 d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
        </div>
        <div class="bg" style="text-align:left;">
            <div class="row">
                {{-- menampilkan data ulasan pesanan dan data pesanan yang diambil dari database lewat API--}}
                @foreach ($data['review'] as $item)
                    @foreach ($dataPesanan['datapesanan'] as $pesanan)
                    @if ($pesanan['_id'] == $item['id_transaksi'])
                    <div class="card-pesanan">
                        <div class="mb-4">
                            {{-- menampilkan username pembeli --}}
                            <div class="card-pesanan-title">Pesanan {{ $pesanan['username'] }}</div>
                            {{-- menampilkan tanggal pesanan --}}
                            <div>{{ date_format(date_create($pesanan['createdAt']), 'd M Y, G:i') }}</div>
                            {{-- menampilkan kota pesanan --}}
                            <div>{{ $pesanan['kota'] }}</div>
                            {{-- menampilkan rating dengan bintang --}}
                            @if ($item['rating'] == '1')
                            <div>
                                <img src="https://i.ibb.co/0BLH4FF/bintang-1.png" alt="">
                            </div>
                            @elseif ($item['rating'] == '2')
                            <div>
                                <img src="https://i.ibb.co/F6SxXgp/bintang-2.png" alt="">
                            </div>
                            @elseif ($item['rating'] == '3')
                            <div>
                                <img src="https://i.ibb.co/cY1FFBK/bintang-3.png" alt="">
                            </div>
                            @elseif ($item['rating'] == '4')
                            <div>
                                <img src="https://i.ibb.co/0hb94QC/bintang-4.png" alt="">
                            </div>
                            @elseif ($item['rating'] == '5')
                            <div>
                                <img src="https://i.ibb.co/M7PJhJt/bintang-5.png" alt="">
                            </div>
                            @endif
                        </div>
                        <div>
                            {{-- menampilkan ulasan --}}
                            <div>{{ $item['review'] }}</div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>
    
@endsection