{{-- script/kode untuk tampilan dashboard reseller  --}}

{{-- menggunakan layout reseller --}}
@extends('layouts.reseller_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        {{-- menampilkan nama toko --}}
        <div class="title-page mb-4">
            <h1 style="font-weight: 600">{{ $data['tokonya']['namatoko'] }}</h1>
        </div>
        <div class="row mb-4">
            <div class="card-summary-reseller">
                <div class="row">
                    <div class="col-3">
                        <div class="card-summary-reseller-icon" style="background-color: #C4EAD0">
                            <span class="iconify" data-icon="bi:bag-check-fill" style="color: #479360; font-size: 36px;"></span>
                        </div>
                    </div>
                    {{-- menampilkan total transaksi --}}
                    <div class="col">
                        <div class="card-summary-reseller-title">Total Transaksi</div>
                        <div class="card-summary-reseller-numbers">{{ $data['totalTransaksi'] }}</div>
                    </div>
                </div>
            </div>
            <div class="card-summary-reseller">
                <div class="row">
                    <div class="col-3">
                        <div class="card-summary-reseller-icon" style="background-color: #C1DAFF">
                            <span class="iconify" data-icon="fa6-solid:money-bill-wave" style="color: #548ADB; font-size: 36px;"></span>
                        </div>
                    </div>
                     {{-- menampilkan total pendapatan --}}
                    <div class="col">
                        <div class="card-summary-reseller-title">Total Pendapatan</div>
                        <div class="card-summary-reseller-numbers">@currency($data['pendapatan'])</div>
                    </div>
                </div>
            </div>
            <div class="card-summary-reseller">
                <div class="row">
                    <div class="col-3">
                        <div class="card-summary-reseller-icon" style="background-color: #FFE3C0">
                            <span class="iconify" data-icon="fa6-solid:wallet" style="color: #A5773F; font-size: 36px;"></span>
                        </div>
                    </div>
                    {{-- menampilkan total saldo sekarang--}}
                    <div class="col">
                        <div class="card-summary-reseller-title">Saldo Sekarang</div>
                        <div class="card-summary-reseller-numbers">@currency($data['tokonya']['saldo'])</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- menampilkan informasi toko --}}
        <div class="bg-informasi-toko mb-4">
            <div>
                <div class="mb-3">
                    <div style="font-weight:600; font-size: 16px">Kontak</div>
                </div>
                <div class="row mb-2" style="font-weight:400; font-size:14px">
                    <div class="col-4 mb-2">Email</div>
                    <div class="col-4 mb-2">{{ $data['tokonya']['email'] }}</div>
                </div>
                <div class="row mb-2" style="font-weight:400; font-size:14px">
                    <div class="col-4 mb-2">Nomor Telepon</div>
                    <div class="col-4 mb-2">{{ $data['tokonya']['phone'] }}</div>
                </div>
                <div class="mb-3" style="font-weight:400; font-size:14px">
                    <div style="font-weight:600; font-size: 16px">Alamat</div>
                </div>
                <div class="row mb-2" style="font-weight:400; font-size:14px">
                    <div class="col-4 mb-2">Provinsi</div>
                    <div class="col-4">{{ $data['tokonya']['provinsi'] }}</div>
                </div>
                <div class="row mb-4" style="font-weight:400; font-size:14px">
                    <div class="col-4 mb-2">Nomor HP</div>
                    <div class="col-4 mb-2">{{ $data['tokonya']['kota'] }}</div>
                </div>
            </div>
        </div>
        {{-- menampilkan informasi produk --}}
        <div class="bg-informasi-toko">
            <div class="row mb-3 title-list-produk">
                <div class="col-1">No.</div>
                <div class="col-5">Nama Produk</div>
                <div class="col-3">Status</div>
                <div class="col-3">Stock</div>
            </div>
            @php
            $no = 1;
            @endphp
            @foreach ($data['tokonya']['stock'] as $item)
            <div class="row mb-3 list-produk">
                <div class="col-1">{{ $no }}</div>
                <div class="col-5">{{ $item['product'] }}</div>
                @if ($item['jumlah'] > 0)
                <div class="col-3 label-ada-stok">Ada Stok</div>
                @elseif ($item['jumlah'] = 0)
                <div class="col-3">Stok Habis</div>
                @endif
                <div class="col-3">{{ $item['jumlah'] }}</div>
            </div>
            @php
                $no++;
            @endphp
            @endforeach
        </div>
    </div>
</div>
    
@endsection