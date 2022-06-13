@extends('layouts.main')

@section('content')
<div class="content">
    <div class="title-page">
        <h1 style="font-weight: 600">Pesanan</h1>
    </div>
    <div class="sub-content">
        <div class="card-buat-pesanan">
            <div style="margin-bottom: 20px"><h4 style="font-weight:600">Form Buat Pesanan</h4></div>
            <div class="form-pesanan">
                <div class="row">
                    <div class="col-6">
                        <div class="sub-title">Data Diri Pembeli</div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="email@example.com">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="sub-title">Alamat Pengiriman</div>
                        <div class="row mb-3">
                            <div class="row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Provinsi</label>
                                <div class="col-4" style="margin-left:12px">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>Pilih Provinsi</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align: right">Kota</label>
                                <div class="col-3">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>Pilih Kota</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Kecamatan</label>
                                <div class="col-4" style="margin-left:12px">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                        <option selected>Pilih Kecamatan</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                                <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align: right">Kode Pos</label>
                                <div class="col-3">
                                    <input class="form-control form-control-sm" type="text" placeholder="Kode Pos" aria-label=".form-control-sm example">                                
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-10" style="margin-left:8px; width: 445px">
                                <textarea class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="2" style="resize: none"></textarea>                            </div>
                        </div>
                    </div>
                </div>
                <div style="margin-top: -50px">
                    <div class="sub-title">Metode Pembayaran</div>
                        <div class="row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                            <div class="col-2">
                                <select class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected>Pilih Pembayaran</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
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
                        <tr class="d-flex">
                            <td class="col-1" style="text-align: left;">
                                <img style="width: 50px; height: 50px;" src="{{ asset('images/durian.jpeg') }}" alt="">
                            </td>
                            <td class="col-5" style="text-align: left;">Durian Pelangi Kupas</td>
                            <td class="col-2" >Rp50.000</td>
                            <td class="col-2">1</td>
                            <td class="col-2" style="text-align: right;">Rp50.000</td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-1" style="text-align: left;">
                                <img style="width: 50px; height: 50px;" src="{{ asset('images/durian.jpeg') }}" alt="">
                            </td>
                            <td class="col-5" style="text-align: left;">Durian Pelangi Kupas</td>
                            <td class="col-2" >Rp50.000</td>
                            <td class="col-2">1</td>
                            <td class="col-2" style="text-align: right;">Rp50.000</td>
                        </tr>
                        <tr class="d-flex">
                            <td class="col-1" style="text-align: left;">
                                <img style="width: 50px; height: 50px;" src="{{ asset('images/durian.jpeg') }}" alt="">
                            </td>
                            <td class="col-5" style="text-align: left;">Durian Pelangi Kupas</td>
                            <td class="col-2" >Rp50.000</td>
                            <td class="col-2">1</td>
                            <td class="col-2" style="text-align: right;">Rp50.000</td>
                        </tr>
                        <tr>
                            <td><hr></td>
                        </tr>
                        <tr class="d-flex" style="text-align: right;">
                            <td class="col-10">Subtotal Pesanan:</td>
                            <td class="col-2">Rp150.000</td>
                        </tr>
                        <tr class="d-flex" style="text-align: right;">
                            <td class="col-10">Ongkos Kirim:</td>
                            <td class="col-2" >Rp9.000</td>
                        </tr>
                        <tr class="d-flex" style="text-align: right;">
                            <td class="col-10">Total pesanan:</td>
                            <td class="col-2" >Rp159.000</td>
                        </tr>
                        <tr class="d-flex" style="text-align: right; margin-top: 16px" >
                            <td class="col-12"><a class="btn btn-primary" href="/pembayaran" role="button">Buat Pesanan</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection