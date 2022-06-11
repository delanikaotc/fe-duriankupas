@extends('layouts.main')

@section('content')
<div class="content">
    <div style="text-align: center">
        <h3 style="font-weight: 500">Selesaikan pembayaran sebelum</h3>
        <h3 style="color: #ffc600">Kamis, 14 April 2022 09:56</h3>
    </div>
    <div class="sub-content">
        <div class="row d-flex justify-content-center">
            <div class="card-pembayaran">
                <div class="row">
                    <div class="col" style="margin-top: 20px">
                        <h5>Bank BNI</h5>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <img class="logo-bank" src="{{ asset('images/bni.png') }}" alt="">
                    </div>
                </div>
                <hr>
                <div class="mb-3">
                    Nomor Rekening Bank
                    <div style="font-weight: 600">80777082246680464</div>
                </div>
                <div>
                    Total Pembayaran
                    <div style="font-weight: 600">Rp159.000</div>
                </div>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col d-flex justify-content-center">
                <a class="btn btn-outline-primary me-3" href="/" role="button">Unggah Bukti Pembayaran</a>
                <a class="btn btn-primary" href="/produk" role="button" style="width: 235px">Belanja Lagi</a>
            </div>
        </div>
        <div style="margin-left: 375px; margin-bottom: 60px">
            <h5 class="mb-2">Cara Pembayaran</h5>
            <div style="width: 500px">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Accordion Item #2
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Accordion Item #3
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection