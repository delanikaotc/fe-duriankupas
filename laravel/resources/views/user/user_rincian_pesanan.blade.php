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
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ date_format(date_create($data['createdAt']), 'd M Y, G:i') }}">
                                </div>
                            </div>
                            <div class="sub-title">Data Diri Pembeli</div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-lg-4 col-md-12 col-sm-12 col-form-label">ID User</label>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['id_user'] }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-lg-4 col-md-12 col-sm-12 col-form-label">Username</label>
                                <div class="col-lg-8 col-md-12 col-sm-12">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['username'] }}">
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
                                    <label for="staticEmail" class="col-lg-3 col-md-12 col-sm-12 ">Provinsi</label>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['provinsi'] }}">
                                    </div>
                                    <label for="staticEmail" class="col-lg-3 col-md-12 col-sm-12 ">Kab/Kota</label>
                                    <div class="col-lg-3 col-md-12 col-sm-12">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['kota'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="row">
                                    <label for="staticEmail" class="col-lg-3 col-md-12 col-sm-12 col-form-label">Kecamatan</label>
                                    <div class="col-lg-3">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['kecamatan'] }}">
                                    </div>
                                    <label for="staticEmail" class="col-lg-3 col-md-12 col-sm-12 col-form-label">Kode Pos</label>
                                    <div class="col-lg-3">
                                        <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="13133">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-lg-2 col-md-12 col-sm-12 col-form-label">Alamat</label>
                                <div class="col-lg-10 col-md-12 col-sm-12">
                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['alamat'] }}">
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
                                    <img style="max-width: 50px; width:100%; height: auto;" src="{{ $produk['img'] }}">
                                <td class="col-5" style="text-align: left;">{{ $item['product'] }}</td>
                                <td class="col-2" >@currency($produk['harga'])</td>
                                <td class="col-2">{{ $item['jumlah'] }}</td>
                                <td class="col-2" style="text-align: right;">@currency($produk['harga'] * $item['jumlah'])</td>
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
                                <td class="col-2">@currency($subtotal)</td>
                            </tr>
                            <tr class="d-flex" style="text-align: right;">
                                <td class="col-10">Ongkos Kirim:</td>
                                <td class="col-2">@currency($ongkir)</td>
                            </tr>
                            <tr class="d-flex" style="text-align: right;">
                                <td class="col-10">Total pesanan:</td>
                                <td class="col-2">@currency($data['total'])
                        </tbody>
                    </table>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection