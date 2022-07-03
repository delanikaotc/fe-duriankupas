{{-- script/kode untuk tampilan halaman data pembeli --}}

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
        @if ($errors->any())
        <div class="sub-content">
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        </div>
        @endif
        <div class="row justify-content-end mb-5">
            <form class="col-4 d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
        </div>
        <div class="bg">
            {{-- menampilkan data pembeli menggunakan table  --}}
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- setiap data pembeli yang didapatkan dari database ditampilkan --}}
                    @foreach ($data as $item)
                    <tr>
                        {{-- menampilkan username, email, nomor telepon dari database --}}
                        <th scope="row">{{ $item['username'] }}</th>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['phone'] }}</td>
                        <td>Jakarta</td>
                        {{-- button untuk mengedit data pembeli yang diarahkan ke halaman edit data pembeli --}}
                        <td class="row d-flex justify-content-center">
                            <div class="col-3">
                                <a href="{{ route('editPembeli', $item['_id']) }}" class="btn btn-edit">
                                    <span class="iconify" data-icon="clarity:edit-solid" style="color: #f2c94c; font-size: 12px; margin-left: -6px"></span>
                                </a>
                            </div>
                        {{-- button untuk menghapus data pembeli --}}
                            <div class="col-3">
                            <form action="{{ route('hapusPembeli', $item['_id']) }}" method="post">
                                {!! method_field('post') . csrf_field() !!}
                                <button type="submit" class="btn btn-tolak">
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