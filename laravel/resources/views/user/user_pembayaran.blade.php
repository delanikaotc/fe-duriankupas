{{-- script/kode untuk tampilan halaman pembayaran --}}

{{-- menggunakan main layout --}}
@extends('layouts.main')

{{-- isi konten yang akan dipanggil di main layout --}}
@section('content')
<div class="content">
  {{-- menampilkan alert error jika ada --}}
  @if ($errors->any())
  <div class="sub-content">
      <div class="alert alert-danger" role="alert">
          {{ $errors->first() }}
      </div>
  </div>
  @endif
  {{-- kondisi apabila status pesanan ditolak maka menampilkan informasi pembayaran ditolak --}}
    @if ($dataPesanan['status'] == 'Pembayaran Ditolak')
    <div style="text-align: center">
      <h3 style="font-weight: 500">Bukti pembayaran sebelumnya ditolak!</h3>
      <h3 style="color: #ffc600">Unggah Kembali Bukti Pembayaranmu</h3>
    </div>
    @else 
    {{-- kondisi sehabis berhasil membuat pesanan, informasi pesanan berhasil dibuat --}}
    <div style="text-align: center">
        <h3 style="font-weight: 500">Pesanan berhasil dibuat!</h3>
        <h3 style="color: #ffc600">Selesaikan pembayaranmu</h3>
    </div>
    @endif
    <div class="sub-content">
        <div class="row d-flex justify-content-center">
          {{-- informasi rekening duriankupas.id --}}
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
          {{-- menampilkan total pesanan dan upload file bukti pembayaran --}}
          <div class="card-pembayaran">
            {{-- form yang apabila diklik submit akan menjalankan fungsi uploadbuktipembayaran dengan id pesanan yang diberikan menggunakan method post --}}
            <form action="{{ route('uploadBuktiPembayaran', $dataPesanan['_id'])}}" method="POST" enctype="multipart/form-data">
              {!! method_field('post') . csrf_field() !!}
              <div class="mb-3">
                {{-- informasi total pesanan --}}
                  <h6>Total Pembayaran</h6>
                  <div style="font-weight: 600">@currency($dataPesanan['total'])</div>
              </div>
              <div class="mb-3">
                {{-- unggah file bukti pembayaran --}}
                <h6>Unggah Bukti Pembayaran</h6>
                  <div class="form-group">
                    <input name="image" type="file" class="form-control-file" id="inputBuktiPembayaran">
                    <div style="color: #c4c4c4; font-size: 12px;">Format gambar harus .png, .jpg, .jpeg</div>
                  </div>
              </div>
          </div>
          {{-- button untuk mengirim upload bukti pembayaran sekarang --}}
          <div class="row mb-3">
              <div class="col d-flex justify-content-center">
                <button class="btn btn-primary" type="submit" style="width: 500px">Kirim Bukti Pembayaran Sekarang</button>
              </div>
          </div>
          {{-- button untuk memberi pilihan transfer nanti --}}
          <div class="row mb-5">
            <div class="col d-flex justify-content-center">
              <a href="{{ route('userPesananView') }}" class="btn btn-outline-primary" style="width: 500px;">Nanti Saja</a>
            </div>
            </div>
        </div>
          </form>
          {{-- informasi cara pembayaran --}}
        <div style="margin-bottom: 60px" class="row d-flex justify-content-center">
          <div style="text-align: center;"><h5 class="mb-2">Cara Pembayaran</h5></div>
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