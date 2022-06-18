@extends('layouts.admin_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        <div class="bg">
            <table class="table table-borderless align-middle">
                <thead>
                  <tr>
                    <th scope="col">Foto Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td>
                            <img src="{{ $item['img'] }}" alt="" class="foto-produk">
                        </td>
                        <td scope="row">{{ $item['nama'] }}</td>
                        <td>{{ $item['deskripsi'] }}</td>
                        <td>{{ $item['harga'] }}</td>
                        <td>114 buah</td>
                        <td>Aktif</td>
                        <td class="row d-flex justify-content-center mt-4">
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