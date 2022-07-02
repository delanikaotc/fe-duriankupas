 {{-- script/kode untuk tampilan halaman data request restock --}}

@extends('layouts.reseller_main')

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
        <div class="row justify-content-end mb-5">
            {{-- button yang mengarahkan reseller ke form oengajuan restock apabila button diklik --}}
            <div class="col d-flex justify-content-end mb-4">
                <a class="btn btn-primary" href="{{ route('resellerFormRestockView') }}" role="button" style="width: 200px">Ajukan Restock</a>
            </div>
        </div>
        <div class="bg">
            {{-- menampilkan data request restock dengan tabel --}}
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Waktu</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        {{-- tanggal restock --}}
                        <th scope="row">{{ date_format(date_create($item['createdAt']), 'd M Y, G:i') }}</th>
                        <td>
                            {{-- setiap ada data produk yang direstock ditampilkan --}}
                            @foreach ($item['product'] as $restock)
                            <div>{{ $restock['product'] }} (x{{ $restock['jumlah'] }})</div>
                            @endforeach
                        </td>
                        {{-- status restock --}}
                        <td>{{ $item['status'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection