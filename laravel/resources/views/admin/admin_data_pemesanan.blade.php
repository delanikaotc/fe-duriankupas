{{-- script/kode untuk tampilan halaman data pemesanan admin --}}

@extends('layouts.admin_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        @if (session()->has('success'))
        <div class="sub-content">
            <div class="alert alert-success" role="alert">
                {{ session()->get('success') }}
            </div>
        </div>
        @endif
        <div class="bg" style="font-size: 14px;">
            {{-- table untuk menampilkan semua data pemesanan dari pembeli --}}
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Username</th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bukti</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- setiap data pemesanan pada array 'verifikasi' yang ada di database diambil --}}
                    @foreach ($data['verifikasi'] as $item)
                    {{-- jika status pemesanan tidak menunggu konfirmasi, akan ditampilkan --}}
                    @if ($item['status'] != 'Menunggu Konfirmasi')
                    <tr>
                        {{-- tanggal pemesanan --}}
                        <th scope="row">{{ date_format(date_create($item['createdAt']), 'd M Y, G:i') }}</th>
                        {{-- username pembeli --}}
                        <th scope="row">{{ $item['username'] }}</th>
                        <td>
                            {{-- setiap pesanan yang diminta pembeli akan ditampilkan --}}
                            @foreach ($item['pesanan'] as $pesanan)
                            <div>{{ $pesanan['product'] }} ({{ $pesanan['jumlah'] }})</div>
                            @endforeach
                        </td>
                        {{-- total harga pesanan --}}
                        <td>@currency($item['total'])</td>
                        {{-- alamat pemesan --}}
                        <td>{{ $item['alamat'] }}, {{ $item['kecamatan'] }}, {{ $item['kota'] }}, {{ $item['provinsi'] }}</td>
                        <td align="center">
                            <div class="">
                                {{-- status dari pemesanan --}}
                                {{ $item['status'] }}
                            </div> 
                        </td>
                        {{-- bukti pembayaran --}}
                        <td><img class="img-bukti-pembayaran" src="{{ $item['buktipembayaran'] }}" alt=""></td>
                        {{-- jika status pesanan adalah verifikasi pembayaran maka akan menampilkan button aksi --}}
                        @if ($item['status'] == 'Verifikasi Pembayaran')
                        <td class="row d-flex justify-content-center">
                            <div class="col-4">
                                {{-- button yang apabila ditekan akan menjalankan fungsi terima bukti pembayaran dengan id pesanan --}}
                                <form action="{{ route('terimaBuktiPembayaran', $item['_id']) }}" method="post">
                                {!! method_field('post') . csrf_field() !!}
                                    <button class="btn btn-terima"type="submit">                                    
                                        <span class="iconify" data-icon="akar-icons:check" style="color: #479360; font-size: 12px; margin-left: -6px"></span>                                
                                    </button>
                                </form>
                            </div>
                            <div class="col-4">
                                {{-- button yang apabila ditekan akan menjalankan fungsi tolak bukti pembayaran dengan id pesanan --}}
                                <form action="{{ route('tolakBuktiPembayaran', $item['_id']) }}" method="post">
                                    {!! method_field('post') . csrf_field() !!}
                                        <button class="btn btn-tolak"type="submit">                                    
                                            <span class="iconify" data-icon="akar-icons:cross" style="color: #f24e1e; font-size: 12px;margin-left: -6px"></span>                                
                                        </button>
                                </form>                         
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                    {{-- menampilkan data pesanan yang sudah ditolak atau diterima (Riwayat pesanan) --}}
                    @foreach ($data['datapesanan'] as $item)
                    @if ($item['status'] != 'Menunggu Konfirmasi')
                    <tr>
                        <th scope="row">{{ date_format(date_create($item['createdAt']), 'd M Y, G:i') }}</th>
                        <th scope="row">{{ $item['username'] }}</th>
                        <td>
                            @foreach ($item['pesanan'] as $pesanan)
                            <div>{{ $pesanan['product'] }} ({{ $pesanan['jumlah'] }})</div>
                            @endforeach
                        </td>
                        <td>{{ $item['total'] }}</td>
                        <td>{{ $item['alamat'] }}, {{ $item['kecamatan'] }}, {{ $item['kota'] }}, {{ $item['provinsi'] }}</td>
                        <td align="center">
                            <div class="">
                                {{ $item['status'] }}
                            </div> 
                        </td>
                        <td><img class="img-bukti-pembayaran" src="{{ $item['buktipembayaran'] }}" alt=""></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection

