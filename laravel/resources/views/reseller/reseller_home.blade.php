@extends('layouts.reseller_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        <div class="row justify-content-end mb-5">
            <form class="col-4 d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
        </div>
        <div class="row mb-4">
            <div class="card-summary-reseller">
                <div class="row">
                    <div class="col-3">
                        <div class="card-summary-reseller-icon" style="background-color: #C4EAD0">
                            <span class="iconify" data-icon="bi:bag-check-fill" style="color: #479360; font-size: 36px;"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-summary-reseller-title">Total Pesanan</div>
                        <div class="card-summary-reseller-numbers">385.987 pcs</div>
                    </div>
                </div>
            </div>
            <div class="card-summary-reseller">
                <div class="row">
                    <div class="col-3">
                        <div class="card-summary-reseller-icon" style="background-color: #C4EAD0">
                            <span class="iconify" data-icon="bi:bag-check-fill" style="color: #479360; font-size: 36px;"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-summary-reseller-title">Total Pesanan</div>
                        <div class="card-summary-reseller-numbers">385.987 pcs</div>
                    </div>
                </div>
            </div>
            <div class="card-summary-reseller">
                <div class="row">
                    <div class="col-3">
                        <div class="card-summary-reseller-icon" style="background-color: #C4EAD0">
                            <span class="iconify" data-icon="bi:bag-check-fill" style="color: #479360; font-size: 36px;"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card-summary-reseller-title">Total Pesanan</div>
                        <div class="card-summary-reseller-numbers">385.987 pcs</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg">
            <div class="row mb-3 title-list-produk">
                <div class="col-1">No.</div>
                <div class="col-5">Nama Produk</div>
                <div class="col-3">Status</div>
                <div class="col-3">Terjual</div>
            </div>
            <div class="row mb-3 list-produk">
                <div class="col-1">1</div>
                <div class="col-5">Durian Monthong Kupas</div>
                <div class="col-3 label-ada-stok">Ada Stok</div>
                <div class="col-3">Terjual</div>
            </div>
            <div class="row mb-3 list-produk">
                <div class="col-1">2</div>
                <div class="col-5">Durian Monthong Kupas</div>
                <div class="col-3 label-ada-stok">Ada Stok</div>
                <div class="col-3">Terjual</div>
            </div>
            <div class="row mb-3 list-produk">
                <div class="col-1">3</div>
                <div class="col-5">Durian Monthong Kupas</div>
                <div class="col-3 label-ada-stok">Ada Stok</div>
                <div class="col-3">Terjual</div>
            </div>
            <div class="row mb-3 list-produk">
                <div class="col-1">4</div>
                <div class="col-5">Durian Monthong Kupas</div>
                <div class="col-3 label-ada-stok">Ada Stok</div>
                <div class="col-3">Terjual</div>
            </div>
        </div>
    </div>
</div>
    
@endsection