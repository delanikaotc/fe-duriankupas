{{-- script/kode untuk tampilan halaman beri ulasan --}}

{{-- menggunakan layout user --}}
@extends('layouts.user_main')

{{-- isi konten beri ulasan yang akan dipanggil lewat layout user --}}
@section('content')
    <div class="content">
        <div class="title-page">
            <h1 style="font-weight: 600">Ulasan Pesanan</h1>
        </div>
        {{-- menampilkan alert error jika ditemukan --}}
        @if ($errors->any())
        <div class="sub-content">
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        </div>
        @endif
        <div class="row">
            @include('partials.sidebar_user')
            <div class="col">
                <div class="bg-user">
                    {{-- form yang apabila diklik submit akan menjalankan fungsi kirimUlasan dengan id pesanan --}}
                    <form action="{{ route('kirimUlasan', $dataPesanan['_id'])  }}" method="POST">
                        {!! method_field('post') . csrf_field() !!}
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Rating</label>
                            <div class="col-sm-3">
                                {{-- pemilihan rating --}}
                                <select name="rating" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected>Pilih Rating</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        {{-- input ulasan --}}
                        <div class="mb-3 row">
                            <label for="inputUlasan" class="col-sm-2 col-form-label">Ulasan</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Beri Ulasan" name="review" class="form-control form-control-sm" id="inputReview" rows="2" style="resize: none"></textarea>                            
                            </div>
                        </div>
                        {{-- button kirim dengan fungsi submit --}}
                        <div class="mb-3 row">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary col-lg-2 col-md-2 col-sm-2">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection