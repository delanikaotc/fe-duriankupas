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
        <div class="bg">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">123JKT</th>
                    <td>Durian Monthong Kupas (x1)</td>
                    <td>Rp45.000</td>
                    <td align="center">
                        <div class="label-sedang-dikirim">
                            Sedang Dikirim
                        </div> 
                    </td>
                    <td class="row d-flex justify-content-center">
                        <div class="col-2 icon-edit me-1">
                            <a href="">
                                <span class="iconify" data-icon="clarity:edit-solid" style="color: #f2c94c; font-size: 12px; margin-left: -6px"></span>
                            </a>
                        </div>
                        <div class="col-2 icon-hapus">
                            <a href="">
                                <span class="iconify" data-icon="bi:trash-fill" style="color: #eb5757; font-size: 12px; margin-left: -6px"></span>                            </a>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">123JKT</th>
                    <td>Durian Monthong Kupas (x1)</td>
                    <td>Rp45.000</td>
                    <td align="center">
                        <div class="label-sedang-dikirim">
                            Sedang Dikirim
                        </div> 
                    </td>
                    <td class="row d-flex justify-content-center">
                        <div class="col-2 icon-edit me-1">
                            <a href="">
                                <span class="iconify" data-icon="clarity:edit-solid" style="color: #f2c94c; font-size: 12px; margin-left: -6px"></span>
                            </a>
                        </div>
                        <div class="col-2 icon-hapus">
                            <a href="">
                                <span class="iconify" data-icon="bi:trash-fill" style="color: #eb5757; font-size: 12px; margin-left: -6px"></span>                            </a>
                        </div>
                    </td>
                  </tr>
                  <tr>
                    <th scope="row">123JKT</th>
                    <td>Durian Monthong Kupas (x1)</td>
                    <td>Rp45.000</td>
                    <td align="center">
                        <div class="label-sedang-dikirim">
                            Sedang Dikirim
                        </div> 
                    </td>
                    <td class="row d-flex justify-content-center">
                        <div class="col-2 icon-edit me-1">
                            <a href="">
                                <span class="iconify" data-icon="clarity:edit-solid" style="color: #f2c94c; font-size: 12px; margin-left: -6px"></span>
                            </a>
                        </div>
                        <div class="col-2 icon-hapus">
                            <a href="">
                                <span class="iconify" data-icon="bi:trash-fill" style="color: #eb5757; font-size: 12px; margin-left: -6px"></span>                            </a>
                        </div>
                    </td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection