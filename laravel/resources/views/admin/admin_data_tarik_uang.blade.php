{{-- script/kode tampilan halaman data tarik uang --}}

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
        <div class="bg">
            {{-- menampilkan data tarik uang dengan tabel --}}
            <table class="table table-borderless">
                <thead>
                    <tr>
                        <th scope="col">Waktu</th>
                        <th scope="col">Nama Toko</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Status</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- menampilkan data tarik uang yang membutuhkan respons dari admin --}}
                    @foreach ($data['datatarikuang'] as $item)
                    <tr>
                        {{-- menampilkan data tarik uang seperti tanggal, nama toko, jumlah penarikan, dan status --}}
                        <th scope="row">{{ date_format(date_create($item['createdAt']), 'd M Y, G:i') }}</th>
                        @foreach ($dataReseller['semuatoko'] as $reseller)
                        @if ($reseller['_id'] == $item['id_toko'])
                        <td>{{ $reseller['namatoko'] }}</td>
                        @endif
                        @endforeach
                        <td>@currency($item['jumlah'])</td>
                        <td>{{ $item['status'] }}</td>
                        {{-- button untuk menambahkan bukti kirim uang --}}
                        <td class="row d-flex justify-content-center">
                            <div class="col-3">
                                <a class="btn btn-terima" href="{{ route('adminFormUploadBuktiView', $item['_id']) }}">
                                    <span class="iconify" data-icon="akar-icons:check" style="color: #479360; font-size: 12px; margin-left: -6px"></span>
                                </a>
                            </div>
                            <div class="col-3">
                                <button class="btn btn-tolak" type="submit">
                                    <span class="iconify" data-icon="akar-icons:cross" style="color: #f24e1e; font-size: 12px;margin-left: -6px"></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    {{-- menampilkan data tarik uang yang sudah selesai --}}
                    @foreach ($data['donetarikuang'] as $item)
                    <tr>
                        <th scope="row">{{ date_format(date_create($item['createdAt']), 'd M Y, G:i') }}</th>
                        @foreach ($dataReseller['semuatoko'] as $reseller)
                        @if ($reseller['_id'] == $item['id_toko'])
                        <td>{{ $reseller['namatoko'] }}</td>
                        @endif
                        @endforeach
                        <td>@currency($item['jumlah'])</td>
                        <td>{{ $item['status'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection