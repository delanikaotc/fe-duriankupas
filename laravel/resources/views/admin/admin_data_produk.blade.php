@extends('layouts.admin_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        @if (session()->has('success'))
            <div class="sub-content">
                <div class="alert alert-success" role="alert">
                    {{ session()->get('success') }}
                </div>
            </div>
        @endif
        <div class="row">
            <div class="col-6">
              <form class="d-flex" role="search">
                  <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </div>
            <div class="col d-flex justify-content-end mb-4">
                <a class="btn btn-primary" href="{{ route('adminFormTambahProdukView') }}" role="button" style="width: 200px">Tambah Produk</a>
            </div>
          </div>
        <div class="bg">
            <table class="table table-borderless align-middle">
                <thead>
                  <tr>
                    <th scope="col">Foto Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Harga</th>
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
                        <td>@currency($item['harg'])</td>
                        <td class="row d-flex justify-content-center mt-3">
                            <div class="col-2 me-1">
                                <a class="btn btn-edit" href="{{ route('adminEditProdukView', $item['_id']) }}">
                                    <span class="iconify" data-icon="clarity:edit-solid" style="color: #f2c94c; font-size: 12px; margin-left: -6px"></span>
                                </a>
                            </div>
                            <div class="col-2">
                              <form action="{{ route('hapusProduk', $item['_id']) }}" method="post">
                                {!! method_field('post') . csrf_field() !!}
                                    <button class="btn btn-tolak"type="submit">                                    
                                      <span class="iconify" data-icon="bi:trash-fill" style="color: #eb5757; font-size: 12px; margin-left: -6px"></span>                          
                                    </button>
                                </form>
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