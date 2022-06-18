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
        <div class="tab-bar">
            <div class="row">
                <div class="col-6 pt-2">
                    <a href="{{ route('resellerDataPemesananBaruView') }}">Pesanan Baru</a>
                </div>
                <div class="col-6 bg-active pt-2">
                    <a style="text-decoration: underline; color: white;" href="{{ route('resellerRiwayatDataPemesananView') }}">Riwayat Pesanan</a>
                </div>
            </div>
        </div>
        <div class="bg">
            <table class="table table-borderless align-center">
                <thead>
                  <tr>
                    <th scope="col">ID Pembeli</th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data['pesananLama'] as $item)
                    <tr>
                        <th scope="row">{{ $item['id_user'] }}</th>
                        <td>
                            @foreach ($item['pesanan'] as $pesanan)
                            <div>{{ $pesanan['product'] }} (x{{ $pesanan['jumlah'] }})</div>
                            @endforeach
                        </td>
                        <td>{{ $item['total'] }}</td>
                        <td align="center">
                            {{-- <div class="label-sedang-dikirim"> --}}
                            <div>
                                {{ $item['status'] }}
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
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection