{{-- script/kode untuk tampilan halaman buat pesanan setelah langkah awal membuat pesanan di halaman produk kami --}}

{{-- menggunakan main layout --}}
@extends('layouts.main')

{{-- isi konten produk kami yang akan dipanggil pada main layout --}}
@section('content')
<div class="content">
    {{-- judul halaman --}}
    <div class="title-page">
        <h1 style="font-weight: 600">Pesanan</h1>
    </div>
    {{-- menampilkan alert error apabila ada --}}
    @if ($errors->any())
    <div class="sub-content">
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    </div>
    @endif
    {{-- form yang akan menjalankan fungsi updatePesanan dengan id pesanan yang telah diberikan menggunakan metode post --}}
    <form action="{{ route('updatePesanan', $dataPesanan['_id']) }}" method="POST">
        {!! method_field('post') . csrf_field() !!}
        <div class="sub-content">
            <div class="card-buat-pesanan">
                <div style="margin-bottom: 20px"><h4 style="font-weight:600">Form Buat Pesanan</h4></div>
                <div class="form-pesanan">
                    <div class="row">
                        <div class="col-6">
                            {{-- data diri pembeli --}}
                            <div class="sub-title">Data Diri Pembeli</div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Username</label>
                                <div class="col-sm-9">
                                    {{ $data['username'] }}
                                    {{-- input hidden untuk mengambil data username pengguna --}}
                                    <input type="hidden" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['username'] }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Nomor HP</label>
                                <div class="col-sm-9">
                                    {{ $data['phone'] }}
                                     {{-- input hidden untuk mengambil data nomor telepon pengguna --}}
                                    <input type="hidden" readonly class="form-control-plaintext" id="staticEmail" value="{{ $data['phone'] }}">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    {{ $data['email'] }}
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="sub-title">Alamat Pengiriman</div>
                            <div class="row mb-3">
                                <div class="row">
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Provinsi</label>
                                    <div class="col-4" style="margin-left:12px">
                                        <select id="provinsi" name="provinsi" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option>Pilih Provinsi</option>
                                            {{-- menampilkan list provinsi yang ada resellernya sesuai dari data pada database --}}
                                            @foreach ($dataDaerah as $item)
                                            <option value="{{ $item['provinsi'] }}">{{ $item['provinsi'] }}</option>      
                                            @endforeach
                                        </select>
                                    </div>
                                    <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align: right">Kab/Kota</label>
                                    <div class="col-3">
                                        {{-- menampilkan list kota yang provinsinya terpilih --}}
                                        <select id="kota" name="kota" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                            <option selected>Pilih Kab/Kota</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="row">
                                    {{-- mengisi kecamatan --}}
                                    <label for="staticEmail" class="col-sm-2 col-form-label">Kecamatan</label>
                                    <div class="col-4" style="margin-left:12px">
                                        <input name="kecamatan" class="form-control form-control-sm" type="text" placeholder="Kecamatan" aria-label=".form-control-sm example">                               
                                    </div>
                                    {{-- mengisi kodepos --}}
                                    <label for="staticEmail" class="col-sm-2 col-form-label" style="text-align: right">Kode Pos</label>
                                    <div class="col-3">
                                        <input name="kodePos" class="form-control form-control-sm" type="text" placeholder="Kode Pos" aria-label=".form-control-sm example">                                
                                    </div>
                                </div>
                            </div>
                            {{-- mengisi alamat --}}
                            <div class="row mb-3">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-10" style="margin-left:8px; width: 445px">
                                    <textarea name="alamat" class="form-control form-control-sm" id="exampleFormControlTextarea1" rows="2" style="resize: none"></textarea>                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub-content">
            <div class="card-buat-pesanan">
                <div class="container-fluid">
                    {{-- tabel rincian pesanan --}}
                    <table id="pesanan" class="table table-borderless" >
                        <thead>
                            <tr class="d-flex">
                                <th class="col-6" colspan="2" style="text-align: left;"><h4 style="font-weight:600">Produk Dipesan</h4></th>
                                <th class="col-2">Harga Satuan</th>
                                <th class="col-2">Jumlah</th>
                                <th class="col-2" style="text-align: right;">Subtotal Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- deklarasi variabel untuk penghitungan total pesanan --}}
                            @php
                            $subtotal = 0;
                            $ongkir = 9000;
                            @endphp
                            
                            {{-- menampilkan data pesanan yang didapat dari halaman produk kami --}}
                            @foreach ($dataPesanan['pesanan'] as $item)
                            <tr class="d-flex">
                                {{-- get data produk untuk disamakan dengan data pemesanan agar mendapatkan informasi gambar, nama, dan harga --}}
                                @foreach ($dataProduk as $produk)
                                @if ($produk['nama'] == $item['product'])
                                <td class="col-1" style="text-align: left;">
                                    <img style="width: 50px; height: 50px;" src="{{ $produk['img']}}" alt="">
                                </td>
                                <td class="col-5" style="text-align: left;">{{ $item['product'] }}</td>
                                <td class="col-2">@currency($produk['harga'])</td>
                                <td class="col-2">{{ $item['jumlah'] }}</td>
                                {{-- menghitung subtotal dengan mengkalikan jumlah dan harga produk --}}
                                <td class="col-2" style="text-align: right;">@currency ($produk['harga'] * $item['jumlah'])
                                </td>
                                {{-- penghitungan total pesanan --}}
                                @php
                                $subtotal += $produk['harga'] * $item['jumlah'];
                                @endphp
                                @endif
                                @endforeach
                            </tr>   
                            @endforeach
                            <tr>
                                <td><hr></td>
                            </tr>
                            <tr class="d-flex" style="text-align: right;">
                                <td class="col-10">Subtotal Pesanan:</td>
                                <td class="col-2">@currency($subtotal)</td>
                            </tr>
                            <tr class="d-flex" style="text-align: right;">
                                <td class="col-10">Ongkos Kirim:</td>
                                <td class="col-2">@currency($ongkir)</td>
                            </tr>
                            <tr class="d-flex" style="text-align: right;">
                                <td class="col-10">Total pesanan:</td>
                                <td class="col-2">
                                    <input style="text-align: right; font-weight: 600;" type="text" readonly class="form-control-plaintext" id="staticEmail" value="@currency($subtotal + $ongkir)">
                                   {{-- input hidden untuk mengambil data total pesanan --}}
                                    <input style="text-align: right; font-weight: 600;" type="hidden" name="total" readonly class="form-control-plaintext" id="staticEmail" value="{{ $subtotal + $ongkir }}">
                                </td>
                            </tr>
                            {{-- button lanjut pembayaran --}}
                            <tr class="d-flex" style="text-align: right; margin-top: 16px" >
                                <td class="col-12">
                                    <button type="submit" class="btn btn-primary" style="width: 300px">Lanjut Pembayaran</button>    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

{{-- script untuk dependent dropdown pada pemilihan provinsi dan kota menggunakan ajax--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
    // setup ajax
    $(function (){
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="crsf-token"]').attr('content')}
        });

        // fungsi dependent dropdown
    $(function(){
        // fungsi dijalankan apabila variabel provinsi dari field provinsi mengalami perubahan isi
        $('#provinsi').on('change', function(){
            // assign nama_provinsi menjadi provinsi yang dipilih di field provinsi
            let nama_provinsi = $('#provinsi').val();
            // membuat ajax dengan method get, menjalankan fungsi getKota, assign nama_provinsi yang didapat
            $.ajax({
                type : 'GET',
                url : "{{ route('getKota') }}",
                data : {nama_provinsi:nama_provinsi},
                cache : false,

                // jika sukses field kota akan menambilkan response dari fungsi getKota yaitu daftar kota 
                // yang sesuai dengan provinsi yang dipilih
                success: function(msg){
                $('#kota').html(msg);
                },
                error: function(data){
                    console.log('error:',data)
                }
            })
        })
    })

    });
</script>