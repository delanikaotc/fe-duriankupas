{{-- script/kode untuk tampilan halaman data restock --}}

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
        <div class="bg">
            {{-- menampilkan data restock dengan tabel --}}
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Waktu</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- menampilkan setiap data restock yang ada pada database datarestock --}}
                    @foreach ($data['dataRestock'] as $item)
                    <tr>
                        <th scope="row">{{ date_format(date_create($item['createdAt']), 'd M Y, G:i') }}</th>
                        {{-- menampilkan data toko --}}
                        @foreach ($dataToko as $toko)
                        @if ($toko['_id'] == $item['id_toko'])
                        <td style="text-align: left;">{{ $toko['namatoko'] }}</td>
                        @endif    
                        @endforeach
                        <td></td>
                        {{-- menampilkan status --}}
                        <td>{{ $item['status'] }}</td>
                        <td class="row d-flex justify-content-center">
                            <div class="col">
                                {{-- button kirim untuk mengubah status --}}
                                <form action="{{ route('kirimRestock', $item['_id']) }}" method="post">
                                {!! method_field('post') . csrf_field() !!}
                                <button class="btn btn-kirim-barang col"type="submit">                                    
                                    <span class="iconify" data-icon="akar-icons:check" style="color: #479360; font-size: 12px; margin-left: -6px"></span>        
                                    Kirim                 
                                </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    {{-- menampilkan produk dan jumlah yang direstock pada data restock --}}
                    @foreach ($item['product'] as $dataRestock)
                    <tr>
                        <th></th>
                        <td style="text-align: left;">{{ $dataRestock['product'] }}</td>
                        <td>{{ $dataRestock['jumlah'] }}</td>
                    </tr> 
                    @endforeach
                    @endforeach

                    {{-- menampilkan data yang telah selesai direstock --}}
                    @foreach ($data['doneRestock'] as $item)
                    <tr>
                        <th scope="row">{{ date_format(date_create($item['createdAt']), 'd M Y, G:i') }}</th>
                        @foreach ($dataToko as $toko)
                        @if ($toko['_id'] == $item['id_toko'])
                        <td style="text-align: left;">{{ $toko['namatoko'] }}</td>
                        @endif    
                        @endforeach
                        <td></td>
                        <td>{{ $item['status'] }}</td>
                    </tr>
                    @foreach ($item['product'] as $dataRestock)
                    <tr>
                        <th></th>
                        <td style="text-align: left;">{{ $dataRestock['product'] }}</td>
                        <td>{{ $dataRestock['jumlah'] }}</td>
                    </tr> 
                    @endforeach
                    @endforeach
                    
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection