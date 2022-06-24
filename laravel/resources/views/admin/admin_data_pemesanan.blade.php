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
        <div class="bg">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Username</th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Bukti</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data['verifikasi'] as $item)
                    @if ($item['status'] != 'Menunggu Konfirmasi')
                    <tr>
                        <th scope="row">{{ $item['createdAt'] }}</th>
                        <th scope="row">{{ $item['username'] }}</th>
                        <td>
                            @foreach ($item['pesanan'] as $pesanan)
                            <div>{{ $pesanan['product'] }} ({{ $pesanan['jumlah'] }})</div>
                            @endforeach
                        </td>
                        <td>@currency($item['total'])</td>
                        <td align="center">
                            <div class="">
                                {{ $item['status'] }}
                            </div> 
                        </td>
                        <td><img class="img-bukti-pembayaran" src="{{ $item['buktipembayaran'] }}" alt=""></td>
                        @if ($item['status'] == 'Verifikasi Pembayaran')
                        <td class="row d-flex justify-content-center">
                            <div class="col-4">
                                <form action="{{ route('terimaBuktiPembayaran', $item['_id']) }}" method="post">
                                {!! method_field('post') . csrf_field() !!}
                                    <button class="btn btn-terima"type="submit">                                    
                                        <span class="iconify" data-icon="akar-icons:check" style="color: #479360; font-size: 12px; margin-left: -6px"></span>                                
                                    </button>
                                </form>
                            </div>
                            <div class="col-4">
                                {{-- <form action="{{ route('terimaBuktiPembayaran') }}" method="post"> --}}
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
                    @foreach ($data['datapesanan'] as $item)
                    @if ($item['status'] != 'Menunggu Konfirmasi')
                    <tr>
                        <th scope="row">{{ $item['username'] }}</th>
                        <td>
                            @foreach ($item['pesanan'] as $pesanan)
                            <div>{{ $pesanan['product'] }} ({{ $pesanan['jumlah'] }})</div>
                            @endforeach
                        </td>
                        <td>{{ $item['total'] }}</td>
                        <td align="center">
                            <div class="">
                                {{ $item['status'] }}
                            </div> 
                        </td>
                        <td><img class="img-bukti-pembayaran" src="{{ $item['buktipembayaran'] }}" alt=""></td>
                        @if ($item['status'] == 'Verifikasi Pembayaran')
                        <td class="row d-flex justify-content-center">
                            <div class="col-4">
                                <form action="{{ route('terimaBuktiPembayaran', $item['_id']) }}" method="post">
                                {!! method_field('post') . csrf_field() !!}
                                    <button class="btn btn-terima"type="submit">                                    
                                        <span class="iconify" data-icon="akar-icons:check" style="color: #479360; font-size: 12px; margin-left: -6px"></span>                                
                                    </button>
                                </form>
                            </div>
                            <div class="col-4">
                                {{-- <form action="{{ route('terimaBuktiPembayaran') }}" method="post"> --}}
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
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection