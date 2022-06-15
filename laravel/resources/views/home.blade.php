@extends('layouts.main')

@section('content') 

<div class="content">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('images/carousel1.png') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/carousel1.png') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('images/carousel1.png') }}" class="d-block w-100" alt="...">
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
<div class="content">
    <div class="title">
        <h2 style="color:#26471D; font-weight: 600; text-align: center">Produk Kami</h2>
    </div>
        {{-- @if (!empty(Cookie::get('accessToken')))
        <p> access token user : {{ Cookie::get('accessToken') }}</p><br>
        <p> id user : {{ Cookie::get('idUser') }}</p><br>
        @endif --}}
    <div class="sub-content row d-flex justify-content-center">
        <div class="card-produk-home">
            <div>
                <img class="card-produk-home image" src="{{ asset('images/durian.jpeg') }}" alt="">
            </div>
            <div class="card-produk-home title">
                Durian Kupas Montong
            </div>
            <div class="card-produk-home price">
                Rp50.000
            </div>
        </div>
        <div class="card-produk-home">
            <div>
                <img class="card-produk-home image" src="{{ asset('images/durian.jpeg') }}" alt="">
            </div>
            <div class="card-produk-home title">
                Durian Kupas Montong
            </div>
            <div class="card-produk-home price">
                Rp50.000
            </div>
        </div>
        <div class="card-produk-home">
            <div>
                <img class="card-produk-home image" src="{{ asset('images/durian.jpeg') }}" alt="">
            </div>
            <div class="card-produk-home title">
                Durian Kupas Montong
            </div>
            <div class="card-produk-home price">
                Rp50.000
            </div>
        </div>
        <div class="card-produk-home">
            <div>
                <img class="card-produk-home image" src="{{ asset('images/durian.jpeg') }}" alt="">
            </div>
            <div class="card-produk-home title">
                Durian Kupas Montong
            </div>
            <div class="card-produk-home price">
                Rp50.000
            </div>
        </div>
        <div class="sub content row">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary">Beli Durian Sekarang</button>    
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="card-benefit">
        <div class="title">
            <h2 style="color:white; font-weight: 600; text-align: center; padding-top: 20px">Mengapa duriankupas.id?</h2>
        </div>
        <div class="sub-content row" style="margin-left: 100px">
            <div class="content-card-benefit">
                <div class="content-card-benefit bg-icon">
                </div>
                <div class="content-card-benefit title">
                    Terpercaya
                </div>
                <div class="content-card-benefit desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                </div>
            </div>
            <div class="content-card-benefit">
                <div class="content-card-benefit bg-icon">
                </div>
                <div class="content-card-benefit title">
                    Terpercaya
                </div>
                <div class="content-card-benefit desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                </div>
            </div>
            <div class="content-card-benefit">
                <div class="content-card-benefit bg-icon">
                </div>
                <div class="content-card-benefit title">
                    Terpercaya
                </div>
                <div class="content-card-benefit desc">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content" style="margin-bottom:60px;">
    <div class="title">
        <h2 style="color:#26471D; font-weight: 600; text-align: center">Kata Mereka tentang duriankupas.id</h2>
    </div>
    <div class="sub-content row d-flex justify-content-center" style="margin-left: 100px">
        <div class="card-review">
            <div>
                <img class="card-review image" src="{{ asset('images/icon1.png') }}" alt="">
            </div>
            <div class="card-review info">
                <h5>Yunita</h5>
                Duriannya enak banget, memuaskan! Anternya juga cepet
            </div>
        </div>
        <div class="card-review">
            <div>
                <img class="card-review image" src="{{ asset('images/icon1.png') }}" alt="">
            </div>
            <div class="card-review info">
                <h5>Yunita</h5>
                Duriannya enak banget, memuaskan! Anternya juga cepet
            </div>
        </div>
    </div>
</div>

@endsection
