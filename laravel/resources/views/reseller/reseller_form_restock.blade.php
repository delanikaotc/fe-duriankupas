{{-- script/kode untuk tampilan form request restock --}}

@extends('layouts.reseller_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        @if ($errors->any())
        <div class="sub-content">
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        </div>
        @endif
        <div class="bg mb-4">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Foto Produk</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Jumlah Request</th>
                  </tr>
                </thead>
                <tbody>
                    {{-- form apabila disubmit akan menjalankan fungsi ajukanrestock --}}
                <form action="{{ route('ajukanRestock') }}" method="post">
                {!! method_field('post') . csrf_field() !!}
                {{-- menampilkan data produk yang tersedia --}}
                    @foreach ($dataProduk as $k => $item)
                    <tr>
                        <th scope="row"><img class="foto-produk" src="{{ $item['img'] }}" alt=""></th>
                        <td>
                            {{ $item['nama'] }}
                            {{-- input hidden untuk nama produk yang dibutuhkan di database --}}
                            <input type="hidden" style="text-align: center" name="ArrRequest[{{ $k }}][product]" type="text" readonly class="form-control-plaintext" id="inputProduct" value="{{ $item['nama'] }}">
                        </td>
                        <td class="d-flex justify-content-center">
                            <div class="col-3">
                                {{-- input jumlah barang yang ingin direstock --}}
                                <input min="1" name="ArrRequest[{{ $k }}][jumlah]" style="text-align: center;" type="number" class="form-control" placeholder="Jumlah" aria-label="Example text with button addon" aria-describedby="button-addon1">       
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
        <div class="row">
            {{-- button untuk submit data form --}}
            <div class="col d-flex justify-content-end" style="margin-left: -24px">
              <button type="submit" class="btn btn-primary">Ajukan Restock</button>    
            </div>
        </div>
    </form>
    </div>
</div>
    
@endsection