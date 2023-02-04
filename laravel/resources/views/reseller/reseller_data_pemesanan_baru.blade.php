{{-- script/kode tampilan halaman data pemesanan reseller --}}

{{-- menggunakan layout reseller --}}
@extends('layouts.reseller_main')

{{-- isi konten data pemesanan yang akan dipanggil pada layout reseller --}}
@section('content')
<div class="content">
    {{-- menampilkan alert success apabila terdapat pesan --}}
    <div class="content-reseller">
        @if (session()->has('success'))
        <div class="sub-content">
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        </div>
        @endif
        <div class="row justify-content-end mb-5">
            <form class="col-4 d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
        </div>
        <div class="tab-bar">
            <div class="row">
                <div class="col-6 bg-active pt-2">
                    <a style="text-decoration: underline; color: white;" href="{{ route('resellerDataPemesananBaruView') }}">Perlu Dikirim</a>
                </div>
                <div class="col-6 pt-2">
                    <a href="{{ route('resellerRiwayatDataPemesananView') }}">Data Pesanan</a>
                </div>
            </div>
        </div>
        <div class="bg">
            {{-- menampilan data pemesananmenggunakan tabel--}}
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Username Pembeli</th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data['pesananBaru'] as $item)
                    <tr>
                        <th scope="row">{{ $item['username'] }}</th>
                        <td>
                            @foreach ($item['pesanan'] as $pesanan)
                            <div>{{ $pesanan['product'] }} (x{{ $pesanan['jumlah'] }})</div>
                            @endforeach
                        </td>
                        <td>@currency($item['total'])</td>
                        <td>{{ $item['alamat'] }}, {{ $item['kecamatan'] }}, {{ $item['kota'] }}, {{ $item['provinsi'] }}</td>
                        <td align="center">
                            <div>
                                {{ $item['status'] }}
                            </div> 
                        </td>
                        <td class="row d-flex justify-content-center">
                            <div class="col">       
                                @if ($status[$item['_id']] == true)
                                    {{-- form untuk button submit, apabila ditekan akan menjalankan fungsi barangDikirim dengan id pesanan --}}
                                    <form action="{{ route('barangDikirim', $item['_id']) }}" method="post">
                                        {!! method_field('post') . csrf_field() !!}
                                        <button class="btn btn-kirim-barang"type="submit">
                                            <span class="iconify" data-icon="akar-icons:check"
                                                style="color: #479360; font-size: 12px; margin-left: -6px"></span>
                                            Kirim Barang
                                        </button>
                                    </form>
                                @else
                                    <p style="color:#eb5757">Stok tidak cukup!</p>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection