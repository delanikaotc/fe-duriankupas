{{-- Script/code berikut adalah implementasi untuk tampilan halaman landing page 
menggunakakan blade.html sesuai ketentuan view pada Laravel --}}

{{-- memanggil bagian layouts.main, layouts untuk halaman-halaman utama --}}
@extends('layouts.main')

{{-- konten-konten dari halaman landing page --}}
@section('content') 
    <div class="content">
        {{-- alert apabila ada error dari aktivitas sebelumnya --}}
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $errors->first() }}
        </div>
        @endif
    </div>
    {{-- menampilkan carousel untuk bagian promosi --}}
    <div class="content">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div>
                    <div class="carousel-item active">
                        <img src="https://i.postimg.cc/W3hJqbyw/carousel1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.postimg.cc/W3hJqbyw/carousel1.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="https://i.postimg.cc/W3hJqbyw/carousel1.png" class="d-block w-100" alt="...">
                    </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                    </button>
                </div> 
            </div>   
        </div>
    </div>
    {{-- menampilkan data produk yang dapat dibeli --}}
    <div class="content">
        <div class="title">
            <h2 style="color:#26471D; font-weight: 600; text-align: center">Produk Kami</h2>
        </div>
        <div class="sub-content row d-flex justify-content-center">
            @foreach ($dataProduk as $item)
            <div class="col card-produk">
                <div>
                    <img class="card-produk-image" src="{{ $item['img'] }}" alt="">
                </div>
                <div class="card-produk-title">
                    {{ $item['nama'] }}
                </div>
                <div class="card-produk-price">
                    @currency($item['harga'])
                </div>
            </div>
            @endforeach
            <div class="sub content row">
                <div class="d-flex justify-content-center">
                    <a class="btn btn-primary" href="/produk" role="button">Beli Durian Sekarang</a>
                </div>
            </div>
        </div>
    </div>
    {{-- menampilkan keuntungan dari berbelanja di duriankupas.id --}}
    <div class="content">
        <div class="row">
            <div class="col d-flex justify-content-center">
                <div class="card-benefit">
                    <div class="title">
                        <h2 style="color:white; font-weight: 600; text-align: center; padding-top: 20px">Mengapa duriankupas.id?</h2>
                    </div>
                    <div class="sub-content row">
                        <div class="col-lg-4 col-md-12 col-sm-12 content-card-benefit">
                            <div class="content-card-benefit-bg-icon d-flex justify-content-center">
                                <span class="iconify icon-benefit" data-icon="bi:emoji-smile-fill"></span>                
                            </div>
                            <div class="content-card-benefit-title">
                                Terpercaya
                            </div>
                            <div class="content-card-benefit-desc">
                            Terpercaya akan mengantarkan durian kupas untuk kamu    
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 content-card-benefit">
                            <div class="content-card-benefit-bg-icon d-flex justify-content-center">
                                <span class="iconify icon-benefit" data-icon="fa-solid:money-bill-wave"></span>
                            </div>
                            <div class="content-card-benefit-title">
                                Murah
                            </div>
                            <div class="content-card-benefit-desc">
                                Harga pas untuk durian kupas berkualitas, rasa dijamin enak
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 content-card-benefit">
                            <div class="content-card-benefit-bg-icon d-flex justify-content-center">
                                <span class="iconify icon-benefit" data-icon="fa-solid:shipping-fast"></span>
                            </div>
                            <div class="content-card-benefit-title">
                                Cepat
                            </div>
                            <div class="content-card-benefit-desc">
                                Durian kupas kamu cepat sampai ke tangan kamu
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- menampilkan ulasan pesanan dari pengguna sebelumnya --}}
    <div class="content" style="margin-bottom:60px;">
        <div class="title">
            <h2 style="color:#26471D; font-weight: 600; text-align: center">Kata Mereka tentang duriankupas.id</h2>
        </div>
        <div class="sub-content row d-flex justify-content-center">
            <div class="card-review mb-5">
                <div>
                    <img class="card-review image" src="https://res.cloudinary.com/db31tyok/image/upload/v1656394232/duriankupas/tyok_qvddud.jpg" alt="">
                </div>
                <div class="card-review info">
                    <h5>Tyok Dazi</h5>
                    Ga ribet, puas, manis! Recommended banget buat para pencinta durian
                </div>
            </div>
            <div class="card-review mb-5">
                <div>
                    <img class="card-review image" src="https://i.postimg.cc/4GWtCkVK/AC0-B29-D7-35-D8-46-CB-8-CA5-349-D257-A1-B0-E-L0-001.jpg" alt="">
                </div>
                <div class="card-review info">
                    <h5>Eryn Nurrul</h5>
                    Aku yang gak suka durian, jadi suka banget karena enak puol!
                </div>
            </div>
        </div>
    </div>    
@endsection
