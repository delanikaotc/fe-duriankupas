{{-- Script/code berikut adalah implementasi untuk tampilan halaman landing page 
menggunakakan blade.html sesuai ketentuan view pada Laravel --}}

{{-- memanggil bagian layouts.main, layouts untuk halaman-halaman utama --}}
@extends('layouts.main')

{{-- konten-konten dari halaman landing page --}}
@section('content') 
    {{-- menampilkan carousel untuk bagian promosi --}}
    <div class="content">
        <div>
            <img src="https://i.ibb.co/RTwdTVy/Group-4235.png" alt="" class="img-header">
        </div>
    </div>

    {{-- menampilkan keuntungan dari berbelanja di duriankupas.id --}}
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
    
    {{-- menampilkan ulasan pesanan dari pengguna sebelumnya --}}
    <div class="content-tentang">
        <div class="row">
            <div class="col">
                <div class="mb-2">
                    <h3>Misi Kami</h3>
                </div>
                <div class="mb-4" style="line-height: 32px">
                    <p> 
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris. Vestibulum justo justo, viverra a nisi nec, dapibus mollis elit. In sed bibendum libero, tempor porta neque. Aenean eleifend nunc in lacinia rhoncus. Nulla dignissim, sapien in suscipit rutrum, mi nunc rutrum mi, vel convallis dolor neque eu mi. 
                    </p>
                </div>
                <div class="row">
                    <div class="card-misi me-4">
                        <div style="font-weight: 700;font-size: 40px;color: #F2C94C;">100+</div>
                        <div style="font-weight: 500;font-size: 18px;">Produk Terjual</div>
                    </div>
                    <div class="card-misi me-4">
                        <div style="font-weight: 700;font-size: 40px;color: #F2C94C;">100+</div>
                        <div style="font-weight: 500;font-size: 18px;">Akun Pembeli</div>
                    </div>
                    <div class="card-misi me-4">
                        <div style="font-weight: 700;font-size: 40px;color: #F2C94C;">100+</div>
                        <div style="font-weight: 500;font-size: 18px;">Cabang Reseller</div>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-end">
                <img style="width: 501px; height: 439.72px;" src="https://i.ibb.co/71b0fGb/Group-4234-1.png" alt="">
            </div>
        </div>
    </div>
    
    <div class="content-tentang">
        <div class="row">
            <div class="col">
                <div class="row">
                    <div class="card-produk-home">
                        <div>
                            <img class="card-produk-home image" src="https://i.ibb.co/x8mLj6J/Rectangle-923.png" alt="">
                        </div>
                        <div class="card-produk-home title">
                            M. Farhan Suherman
                        </div>
                        <div class="card-produk-home price">
                            Tim Marketing
                        </div>
                    </div>
                    <div class="card-produk-home">
                        <div>
                            <img class="card-produk-home image" src="https://i.ibb.co/m8wvLSb/Rectangle-923-1.png" alt="">
                        </div>
                        <div class="card-produk-home title">
                            Asma
                        </div>
                        <div class="card-produk-home price">
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

    <div class="content-tentang" style="margin-bottom:60px; text-align: center;">
        <div class="mb-4">
            <h3>Dapatkan Promo Menarik</h3>
        </div>
        <div class="mb-4">
            <p style="line-height:32px;">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris.</p>
        </div>
        <div class="row mb-4">
            <div class="card-promo me-4">
                <div class="mb-3">
                    <img class="img-promo" src="https://i.ibb.co/4VfP4Tb/Screen-Shot-2022-07-16-at-16-03-53.png" alt="">
                </div>
                <div>Promo Ramadhan</div>
            </div>
            <div class="card-promo me-4">
                <div class="mb-3">
                    <img class="img-promo" src="https://i.ibb.co/ccKYZz3/Screen-Shot-2022-07-16-at-16-04-30.png" alt="">
                </div>
                <div>Promo Gratis Ongkir</div>
            </div>
            <div class="card-promo me-4">
                <div class="mb-3">
                    <img class="img-promo" src="https://i.ibb.co/nLZGjRB/Screen-Shot-2022-07-16-at-16-04-40.png" alt="">
                </div>
                <div>Promo Durian Monthong</div>
            </div>
        </div>
        <div class="mb-4">
            <h4>dan masih banyak lagi!</h4>
        </div>
    </div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

@endsection
