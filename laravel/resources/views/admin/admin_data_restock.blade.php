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
                    @foreach ($data['dataRestock'] as $item)
                    <tr>
                        <th scope="row">{{ $item['createdAt'] }}</th>
                        <td style="text-align: left;">{{ $item['_id'] }}</td>
                        <td></td>
                        <td>{{ $item['status'] }}</td>
                        <td class="row d-flex justify-content-center">
                            <div class="col-4">
                                <form action="{{ route('kirimRestock', $item['_id']) }}" method="post">
                                {!! method_field('post') . csrf_field() !!}
                                    <button class="btn btn-terima"type="submit">                                    
                                        <span class="iconify" data-icon="akar-icons:check" style="color: #479360; font-size: 12px; margin-left: -6px"></span>                                
                                    </button>
                                </form>
                            </div>
                            <div class="col-4">
                                {{-- <form action="{{ route('terimaBuktiPembayaran') }}" method="post"> --}}
                                {!! method_field('post') . csrf_field() !!}
                                    <button class="btn btn-tolak"type="submit">                                    
                                        <span class="iconify" data-icon="akar-icons:cross" style="color: #f24e1e; font-size: 12px;margin-left: -6px"></span>                                   
                                    </button>
                                </form>                           
                            </div>
                        </td>
                    </tr>
                    @foreach ($item['product'] as $dataRestock)
                    <tr>
                        <th></th>
                        <td style="text-align: left;">{{ $dataRestock['product'] }}</td>
                        <td>{{ $dataRestock['jumlah'] }}</td>
                    </tr> 
                    @endforeach
                    @endforeach

                    @foreach ($data['doneRestock'] as $item)
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