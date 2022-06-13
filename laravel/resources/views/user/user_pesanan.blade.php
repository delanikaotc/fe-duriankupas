@extends('layouts.user_main')

@section('content')
<div class="content">
    <div class="title-page">
        <h1 style="font-weight: 600">Daftar Pesanan</h1>
    </div>
    <div class="sub-content">
        <div class="row">
            @include('partials.sidebar_user')
            <div class="col">
                <div class="bg-user">
                    <div class="row">
                        <div class="col-6">
                            <form class="d-flex" role="search">
                                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                        <div class="col d-flex justify-content-end mb-4">
                            <a class="btn btn-primary" href="/buat-pesanan" role="button" style="width: 200px">Buat Pesanan Baru</a>
                        </div>
                        <div class="row">
                            {{-- <div class="col-4 me-2"> --}}
                                <div class="card-pesanan">
                                    <div class="mb-4">
                                        <div class="card-pesanan-title">Pesanan #12345JKT</div>
                                        <div>7 April 2022</div>
                                        <div class="label-selesai">Selesai</div>
                                    </div>
                                    <div>
                                        <div>Durian Montong Kupas (x1)</div>
                                        <div>Rp50.000</div>
                                    </div>
                                    <div>
                                        <div>Durian Montong Kupas (x1)</div>
                                        <div>Rp50.000</div>
                                    </div>
                                    <hr>
                                    <div class="row mb-4" style="font-weight: 600">
                                        <div class="col">Total Belanja</div>
                                        <div class="col d-flex justify-content-end">Rp50.000</div>
                                    </div>
                                    <div>
                                        <a class="btn btn-primary mb-2" href="/pesanan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Beri Ulasan</a>
                                        <a class="btn btn-outline-primary" href="/pesanan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Cek Status Pembayaran</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            {{-- <div class="col-4 me-2"> --}}
                                <div class="card-pesanan">
                                    <div class="mb-4">
                                        <div class="card-pesanan-title">Pesanan #12345JKT</div>
                                        <div>7 April 2022</div>
                                        <div class="label-selesai">Selesai</div>                                    </div>
                                    <div>
                                        <div>Durian Montong Kupas (x1)</div>
                                        <div>Rp50.000</div>
                                    </div>
                                    <div>
                                        <div>Durian Montong Kupas (x1)</div>
                                        <div>Rp50.000</div>
                                    </div>
                                    <hr>
                                    <div class="row mb-4" style="font-weight: 600">
                                        <div class="col">Total Belanja</div>
                                        <div class="col d-flex justify-content-end">Rp50.000</div>
                                    </div>
                                    <div>
                                        <a class="btn btn-primary mb-2" href="/pesanan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Beri Ulasan</a>
                                        <a class="btn btn-outline-primary" href="/pesanan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Cek Status Pembayaran</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            {{-- <div class="col-4"> --}}
                                <div class="card-pesanan">
                                    <div class="mb-4">
                                        <div class="card-pesanan-title">Pesanan #12345JKT</div>
                                        <div>7 April 2022</div>
                                        <div class="label-sedang-diantar">Sedang Diantar</div>
                                    </div>
                                    <div>
                                        <div>Durian Montong Kupas (x1)</div>
                                        <div>Rp50.000</div>
                                    </div>
                                    <div>
                                        <div>Durian Montong Kupas (x1)</div>
                                        <div>Rp50.000</div>
                                    </div>
                                    <hr>
                                    <div class="row mb-4" style="font-weight: 600">
                                        <div class="col">Total Belanja</div>
                                        <div class="col d-flex justify-content-end">Rp50.000</div>
                                    </div>
                                    <div>
                                        <a class="btn btn-primary mb-2" href="/pesanan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Beri Ulasan</a>
                                        <a class="btn btn-outline-primary" href="/pesanan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Cek Status Pembayaran</a>
                                    </div>
                                </div>
                            {{-- </div> --}}
                            <div class="card-pesanan">
                                <div class="mb-4">
                                    <div class="card-pesanan-title">Pesanan #12345JKT</div>
                                    <div>7 April 2022</div>
                                    <div class="label-sedang-diantar">Sedang Diantar</div>
                                </div>
                                <div>
                                    <div>Durian Montong Kupas (x1)</div>
                                    <div>Rp50.000</div>
                                </div>
                                <div>
                                    <div>Durian Montong Kupas (x1)</div>
                                    <div>Rp50.000</div>
                                </div>
                                <hr>
                                <div class="row mb-4" style="font-weight: 600">
                                    <div class="col">Total Belanja</div>
                                    <div class="col d-flex justify-content-end">Rp50.000</div>
                                </div>
                                <div>
                                    <a class="btn btn-primary mb-2" href="/ulasan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Beri Ulasan</a>
                                    <a class="btn btn-outline-primary" href="/pesanan" role="button" style="width: 227px; height: 30px; font-size: 12px;">Cek Status Pembayaran</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection