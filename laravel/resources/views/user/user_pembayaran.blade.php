@extends('layouts.main')

@section('content')
<div class="content">
    <div style="text-align: center">
        <h3 style="font-weight: 500">Pesanan berhasil dibuat!</h3>
        <h3 style="color: #ffc600">Selesaikan pembayaranmu</h3>
    </div>
    <div class="sub-content">
        <div class="row d-flex justify-content-center">
          <div class="row d-flex justify-content-center">
            <div class="card-bank me-3">
              <div class="mb-3 d-flex justify-content-center">
                <img class="logo-bank" src="{{ asset('images/bni.png') }}" alt="">
              </div>
              <hr>
              <div style="font-size: 16px">Nomor Rekening: 12345678</div>
              <div style="font-size: 16px">Nama Rekening: Bobby Rusdiantoro</div>
            </div>
            <div class="card-bank me-3">
              <div class="mb-3 d-flex justify-content-center">
                <img class="logo-bank" src="{{ asset('images/bni.png') }}" alt="">
              </div>
              <hr>
              <div style="font-size: 16px">Nomor Rekening: 12345678</div>
              <div style="font-size: 16px">Nama Rekening: Bobby Rusdiantoro</div>
            </div>
            <div class="card-bank me-3">
              <div class="mb-3 d-flex justify-content-center">
                <img class="logo-bank" src="{{ asset('images/bni.png') }}" alt="">
              </div>
              <hr>
              <div style="font-size: 16px">Nomor Rekening: 12345678</div>
              <div style="font-size: 16px">Nama Rekening: Bobby Rusdiantoro</div>
            </div>
          </div>
          <div class="card-pembayaran">
            <form action="{{ route('uploadBuktiPembayaran', $dataPesanan['_id'])}}" method="POST">
              {!! method_field('post') . csrf_field() !!}
              <div class="mb-3">
                  <h6>Total Pembayaran</h6>
                  <div style="font-weight: 600">{{ $dataPesanan['total'] }}</div>
              </div>
              <div class="mb-3">
                <h6>Unggah Bukti Pembayaran</h6>
                  <div class="form-group">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="buktiPembayaran">
                    {{-- <input name="buktipembayaran" type="file" class="form-control-file" id="exampleFormControlFile1"> --}}
                  </div>
              </div>
          </div>
          <div class="row mb-5">
              <div class="col d-flex justify-content-center">
                <button class="btn btn-primary" type="submit" style="width: 500px">Kirim Bukti Pembayaran</button>
              </div>
          </div>
          </form>
        <div style="margin-left: 375px; margin-bottom: 60px">
            <h5 class="mb-2">Cara Pembayaran</h5>
            <div style="width: 500px">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Mobile Banking
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
                          ATM 
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
</div>
@endsection