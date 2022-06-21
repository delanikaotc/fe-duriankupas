@extends('layouts.main')

@section('content')
<div class="content">
    <div class="title-page">
        <h1 style="font-weight: 600">Pesanan</h1>
    </div>
    <div class="sub-content">
        <div class="card-buat-pesanan">
            <div style="margin-bottom: 20px"><h4 style="font-weight:600">Informasi Pesanan</h4></div>
            <div class="form-pesanan">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-4 col-form-label">Tanggal Pesanan</label>
                            <div class="col-sm-3" >
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['createdAt'] }}">
                            </div>
                        </div>
                        <div class="sub-title">Data Diri Pembeli</div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">ID User</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['id_user'] }}">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['username'] }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="sub-title">Alamat Pengiriman</div>
                        <div class="row mb-3">
                            <div class="row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-4" style="margin-left:12px">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['provinsi'] }}">
                                </div>
                                <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align: right">Kota</label>
                                <div class="col-3">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['kota'] }}">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-4" style="margin-left:12px">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['kecamatan'] }}">
                                </div>
                                <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align: right">Kode Pos</label>
                                <div class="col-3">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="13133">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-10" style="margin-left:8px; width: 445px">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['alamat'] }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div style="">
                    <div class="sub-title">Metode Pembayaran</div>
                        <div class="row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                            <div class="col-2">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Transfer BNI">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sub-content">
        <div class="card-buat-pesanan">
            <div class="container-fluid">
                <table id="pesanan" class="table table-borderless" >
                    <thead>
                        <tr class="d-flex">
                            <th class="col-6" colspan="2" style="text-align: left;"><h4 style="font-weight:600">Produk Dipesan</h4></th>
                            <th class="col-2">Harga Satuan</th>
                            <th class="col-2">Jumlah</th>
                            <th class="col-2" style="text-align: right;">Subtotal Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subtotal = 0;
                            $ongkir = 9000;
                        @endphp
                            
                        @foreach ($data['pesanan'] as $item)
                        <tr class="d-flex">
                            @foreach ($dataProduk as $produk)
                            @if ($produk['nama'] == $item['product'])
                            <td class="col-1" style="text-align: left;">
                                <img style="width: 50px; height: 50px;" src="{{ $produk['img'] }}">
                            <td class="col-5" style="text-align: left;">{{ $item['product'] }}</td>
                            <td class="col-2" >{{ $item['jumlah'] }}</td>
                            <td class="col-2">{{ $produk['harga'] }}</td>
                            <td class="col-2" style="text-align: right;">{{ $produk['harga'] * $item['jumlah'] }}</td>
                            @php
                                $subtotal += $produk['harga'] * $item['jumlah'];
                            @endphp
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                        <tr>
                            <td><hr></td>
                        </tr>
                        <tr class="d-flex" style="text-align: right;">
                            <td class="col-10">Subtotal Pesanan:</td>
                            <td class="col-2">{{ $subtotal }}</td>
                        </tr>
                        <tr class="d-flex" style="text-align: right;">
                            <td class="col-10">Ongkos Kirim:</td>
                            <td class="col-2">{{ $ongkir }}</td>
                        </tr>
                        <tr class="d-flex" style="text-align: right;">
                            <td class="col-10">Total pesanan:</td>
                            <td class="col-2">{{ $data['total']}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection