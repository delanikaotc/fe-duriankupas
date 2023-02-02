{{-- Script/code berikut adalah implementasi untuk tampilan halaman tentang --}}

{{-- memanggil bagian layouts.main, layouts untuk halaman-halaman utama --}}
@extends('layouts.main')

{{-- konten-konten dari halaman tentang --}}
@section('content') 
    {{-- menampilkan gambar header untuk duriankupas.id --}}
    <div class="content">
        <div>
            <img src="https://i.ibb.co/RTwdTVy/Group-4235.png" alt="" class="img-header">
        </div>
    </div>

    {{-- menampilkan informasi dari duriankupas.id--}}
    <div class="content-tentang" style="text-align: center;">
        <div class="mb-4">
            <h3>duriankupas.id</h3>
        </div>
        <div class="mb-4">
            <p style="line-height:32px;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris. Vestibulum justo justo, viverra a nisi nec, dapibus mollis elit. In sed bibendum libero, tempor porta neque. Aenean eleifend nunc in lacinia rhoncus. Nulla dignissim, sapien in suscipit rutrum, mi nunc rutrum mi, vel convallis dolor neque eu mi. </p>
        </div>
        <div>
            <a class="btn btn-primary" href="/produk" role="button">Beli Durian Sekarang</a>
        </div>
    </div>
    
    {{-- menampilkan pencapaian dari duriankupas.id --}}
    <div class="content-tentang">
        <div class="row">
            <div class="col-lg col-sm-12 col-md-12">
                <div class="mb-2">
                    <h3>Misi Kami</h3>
                </div>
                <div class="mb-4" style="line-height: 32px">
                    <p> 
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris. Vestibulum justo justo, viverra a nisi nec, dapibus mollis elit. In sed bibendum libero, tempor porta neque. Aenean eleifend nunc in lacinia rhoncus. Nulla dignissim, sapien in suscipit rutrum, mi nunc rutrum mi, vel convallis dolor neque eu mi. 
                    </p>
                </div>
                <div class="row">
                    <div class="card-misi me-4 mb-4">
                        <div style="font-weight: 700;font-size: 40px;color: #F2C94C;">100+</div>
                        <div style="font-weight: 500;font-size: 18px;">Produk Terjual</div>
                    </div>
                    <div class="card-misi me-4 mb-4">
                        <div style="font-weight: 700;font-size: 40px;color: #F2C94C;">100+</div>
                        <div style="font-weight: 500;font-size: 18px;">Akun Pembeli</div>
                    </div>
                    <div class="card-misi me-4 mb-4">
                        <div style="font-weight: 700;font-size: 40px;color: #F2C94C;">100+</div>
                        <div style="font-weight: 500;font-size: 18px;">Cabang Reseller</div>
                    </div>
                </div>
            </div>
            <div class="col-lg col-sm-12 col-md-12 d-flex justify-content-end">
                <img style="max-width: 500px; width: 100%; height: auto;" src="https://i.ibb.co/71b0fGb/Group-4234-1.png" alt="">
            </div>
        </div>
    </div>
    
    {{-- menampilkan pengelola dari duriankupas.id --}}
    <div class="content-tentang">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="col card-produk">
                        <div>
                            <img class="card-produk image" src="https://i.ibb.co/x8mLj6J/Rectangle-923.png" alt="">
                        </div>
                        <div class="card-produk title">
                            M. Farhan Suherman
                        </div>
                        <div class="card-produk price">
                            Tim Marketing
                        </div>
                    </div>
                    <div class="col card-produk">
                        <div>
                            <img class="card-produk image" src="https://i.ibb.co/m8wvLSb/Rectangle-923-1.png" alt="">
                        </div>
                        <div class="card-produk title">
                            Asma
                        </div>
                        <div class="card-produk price">
                            Tim Operasional
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="mb-2">
                    <h3>Meet Our Team!</h3>
                </div>
                <div class="mb-4" style="line-height: 32px">
                    <p> 
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris. Vestibulum justo justo, viverra a nisi nec, dapibus mollis elit. In sed bibendum libero, tempor porta neque. Aenean eleifend nunc in lacinia rhoncus. Nulla dignissim, sapien in suscipit rutrum, mi nunc rutrum mi, vel convallis dolor neque eu mi. 
                    </p>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
    </div>

    {{-- menampilkan promosi promosi dari duriankupas.id --}}
    <div class="content-tentang" style="margin-bottom:60px; text-align: center;">
        <div class="mb-4">
            <h3>Dapatkan Promo Menarik</h3>
        </div>
        <div class="mb-4">
            <p style="line-height:32px;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris.</p>
        </div>
        <div class="row mb-4 d-flex justify-content-center">
            <a class="col-lg-3 col-sm-12 col-md-12 card-promo" href="https://www.instagram.com/p/Cb2Jhg3v-9V/" style="text-decoration: none; color: #212427;">
                <div>
                    <div class="mb-3">
                        <img class="img-promo" src="https://i.ibb.co/4VfP4Tb/Screen-Shot-2022-07-16-at-16-03-53.png" alt="">
                    </div>
                    <div class="mb-3">Promo Ramadhan</div>
                </div>    
            </a>
           <a class="col-lg-3 col-sm-12 col-md-12 card-promo" href="https://www.instagram.com/p/CW-izTyPaq6/" style="text-decoration: none; color: #212427;">
            <div>
                <div class="mb-3">
                    <img class="img-promo" src="https://i.ibb.co/ccKYZz3/Screen-Shot-2022-07-16-at-16-04-30.png" alt="">
                </div>
                <div class="mb-3">Promo Gratis Ongkir</div>
            </div>
           </a>
            <a class="col-lg-3 col-sm-12 col-md-12 card-promo" href="https://www.instagram.com/p/CXIupBhvfKd/" style="text-decoration: none; color: #212427;">
                <div>
                    <div class="mb-3">
                        <img class="img-promo" src="https://i.ibb.co/nLZGjRB/Screen-Shot-2022-07-16-at-16-04-40.png" alt="">
                    </div>
                    <div class="mb-3">Promo Durian Monthong</div>
                </div>
            </a>
        </div>
        <div class="mb-4">
            <h4>dan masih banyak lagi!</h4>
        </div>
    </div>    
@endsection
