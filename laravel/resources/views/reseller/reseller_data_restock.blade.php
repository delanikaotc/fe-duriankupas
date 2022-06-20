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
            <div class="col d-flex justify-content-end mb-4">
                <a class="btn btn-primary" href="{{ route('resellerFormRestockView') }}" role="button" style="width: 200px">Ajukan Restock</a>
            </div>
        </div>
        <div class="bg">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Waktu</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ $item['createdAt'] }}</th>
                        <td style="text-align: left;">{{ $item['_id'] }}</td>
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