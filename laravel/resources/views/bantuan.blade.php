{{-- Script/code berikut adalah implementasi untuk tampilan bantuan --}}

{{-- memanggil bagian layouts.main, layouts untuk halaman-halaman utama --}}
@extends('layouts.main')

{{-- konten-konten dari halaman bantuan--}}
@section('content') 
    {{-- menampilkan kontak yang dapat dihubungi--}}
    <div class="content mb-4">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 me-4">
                <img class="img-hubungi" src="https://i.ibb.co/Ns5YGHf/Group-4247.png" alt="">
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-4">
                <div class="mb-4">
                    <h3 class="mb-4">Punya Pertanyaan?</h3>
                    <p>Jika punya pertanyaan atau masalah, hubungi kami di:</p>            
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-lg-5 col-md-12 col-sm-12 card-kontak me-4">
                            <div class="row mb-4">
                                <div class="col-1 me-3">
                                    <span class="iconify" data-icon="fluent:call-28-filled" style="color: #212427; font-size: 28px;"></span>
                                </div>
                                <div class="col mb-4">Customer Service</div>
                                <div style="color: #F2C94C; font-size: 24px; text-align:center;">0813-8757-2584</div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12 col-sm-12 card-kontak">
                            <div class="row mb-4">
                                <div class="col-1 me-3">
                                    <span class="iconify" data-icon="ant-design:instagram-filled" style="color: #212427; font-size: 28px;"></span>                                </div>
                                <div class="col mb-4">Instagram</div>
                                <div style="color: #F2C94C; font-size: 24px; text-align:center;">@duriankupas.id</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- menampilkan pertanyaan yang sering ditanya atau faq --}}
    <div class="content-tentang" style="margin-bottom:60px; text-align: center;">
        <div class="mb-4">
            <h3>Frequently Asked Question</h3>
        </div>
        <div style="margin-bottom: 60px" class="row d-flex justify-content-center">
              <div>
                  <div class="accordion" id="accordionExample">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Apakah bisa COD?
                          </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                          <div class="accordion-body" style="text-align: left">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris.</p>
                        </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Bagaimana cara melakukan pembelian?
                          </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                          <div class="accordion-body" style="text-align: left">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris.</p>
                        </div>
                        </div>
                      </div>
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Bagaimana cara menukar durian yang kurang enak rasanya?
                          </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                          <div class="accordion-body" style="text-align: left">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam eu diam nec lorem ornare molestie ac ac mauris.</p>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
          </div>
    </div>    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

@endsection
