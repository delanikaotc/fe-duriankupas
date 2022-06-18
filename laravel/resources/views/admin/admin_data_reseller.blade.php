@extends('layouts.admin_main')

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
                    <th scope="col">Nama Reseller</th>
                    <th scope="col">Nama Toko</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Provinsi</th>
                    <th scope="col">Kota</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data['semuatoko'] as $item)
                  <tr>
                    @foreach ($data['reseller'] as $reseller)
                    @if ($reseller['_id'] == $item['id_user'])
                    <th scope="row">{{ $reseller['username'] }}</th>       
                    @endif
                    @endforeach
                    <td>{{ $item['namatoko'] }}</td>
                    <td>{{ $item['phone'] }}</td>
                    <td>{{ $item['provinsi'] }}</td>
                    <td>{{ $item['kota'] }}</td>
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