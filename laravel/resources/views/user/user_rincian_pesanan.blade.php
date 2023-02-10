@extends('layouts.main')

@section('content')
<div class="content">
    <div class="title-page">
        <h1 style="font-weight: 600">Pesanan</h1>
    </div>
    <div class="sub-content">
        <div>
            <div style="margin-bottom: 20px"><h4 style="font-weight:600">Informasi Pesanan</h4></div>
            <div class="form-pesanan">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-sm-12 mr-2 mb-2">
                        <div class="card-buat-pesanan">
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-lg-4 col-md-12 col-sm-12 mr-2 mb-2 col-form-label">Tanggal Pesanan</label>
                                <div class="col-lg-8 col-md-12 col-sm-12" >
                                    <p>{{ date_format(date_create($data['createdAt']), 'd M Y, G:i') }}</p>
                                </div>
                            </div>
                            <div class="sub-title">Data Diri Pembeli</div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-lg-4 col-md-12 col-sm-12 col-form-label">ID User</label>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <p>{{ $data['id_user'] }}</p>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-lg-4 col-md-12 col-sm-12 col-form-label">Username</label>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <p>{{ $data['username'] }}</p>
                                </div>
                            </div>
                            <div class="sub-title">Metode Pembayaran</div>
                            <div class="row">
                            <label for="staticEmail" class="col-lg-4 col-md-12 col-sm-12 col-form-label">Metode Pembayaran</label>
                            <div class="col-lg-8 col-md-12 col-sm-12">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="Transfer BNI">
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-sm-12">
                        <div class="card-buat-pesanan">
                            <div class="sub-title">Alamat Pengiriman</div>
                            <div class="row mb-3">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                                        <p>Provinsi</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p>{{ $data['provinsi'] }}</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                                        <p>Kab/Kota</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p>{{ $data['kota'] }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                                        <p>Kec.</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p>{{ $data['kecamatan'] }}</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                                        <p>Kode Pos</p>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        <p>13133</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
                                    <p>Alamat</p>
                                </div>
                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <p>{{ $data['alamat'] }}</p>
                                </div>
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
                <div style="overflow-x:auto;">
                    <table id="pesanan" class="table table-borderless" >
                        <thead>
                            <tr>
                                <th colspan="2" style="text-align: left;"><h4 style="font-weight:600">Produk Dipesan</h4></th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th style="text-align: right;">Subtotal Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                                $ongkir = 9000;
                            @endphp
                                
                            @foreach ($data['pesanan'] as $item)
                            <tr>
                                @foreach ($dataProduk as $produk)
                                @if ($produk['nama'] == $item['product'])
                                <td colspan="2" style="text-align: left;">
                                    <img style="max-width: 50px; width:100%; height: auto;" src="{{ $produk['img'] }}">
                                    {{ $item['product'] }}
                                <td >@currency($produk['harga'])</td>
                                <td>{{ $item['jumlah'] }}</td>
                                <td style="text-align: right;">@currency($produk['harga'] * $item['jumlah'])</td>
                                @php
                                    $subtotal += $produk['harga'] * $item['jumlah'];
                                @endphp
                                @endif
                                @endforeach
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="5"><hr></td>
                            </tr>
                            <tr style="text-align: right;">
                                <td colspan="4">Subtotal Pesanan:</td>
                                <td colspan="1">@currency($subtotal)</td>
                            </tr>
                            <tr style="text-align: right;">
                                <td colspan="4">Ongkos Kirim:</td>
                                <td colspan="1">@currency($ongkir)</td>
                            </tr>
                            <tr style="text-align: right;">
                                <td colspan="4">Total pesanan:</td>
                                <td colspan="1">@currency($data['total'])
                        </tbody>
                    </table>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection