{{-- Berikut merupakan script/kode dari tampilan Footer untuk menemukan informasi dengan cepat --}}


<footer class="text-center text-lg-start bg-light text-muted">
    <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom" ></section>
    <section class="">
      <div class="container text-center text-md-start mt-5">
        {{-- info singkat mengenai duriankupas.id  --}}
        <div class="row mt-3">
          <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold mb-4">
              <img class="icon-footer" src="https://i.ibb.co/p3Zft36/logo.png" alt=""> duriankupas.id
            </h6>
            <p>
              Siap antar durian kupas berkualitas ke rumah kamu! Durian kupas pilihan yang dapat kamu pesan
            </p>
          </div>
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            {{-- link cepat untuk akses halaman  --}}
            <h6 class="text-uppercase fw-bold mb-4">
              Link
            </h6>
            <p>
              <a href="{{ route('daftarView') }}" class="text-reset">Daftar</a>
            </p>
            <p>
              <a href="{{ route('masukView') }}" class="text-reset">Masuk</a>
            </p>
            <p>
              <a href="{{ route('produkView') }}" class="text-reset">Produk Kami</a>
            </p>
            <p>
              <a href="https://wa.me/6281289078298" class="text-reset">Jadi Reseller</a>
            </p>
            <p>
              <a href="{{ route('tentangView') }}" class="text-reset">Tentang Kami</a>
            </p>
            <p>
              <a href="{{ route('bantuanView') }}" class="text-reset">Bantuan</a>
            </p>
          </div>
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            {{-- memperlihatkan daftar produk  --}}
            <h6 class="text-uppercase fw-bold mb-4">
              Produk Kami
            </h6>
            <p>
              <a href="{{ route('produkView') }}" class="text-reset">Durian Montong</a>
            </p>
            <p>
              <a href="{{ route('produkView') }}" class="text-reset">Durian Medan</a>
            </p>
          </div>
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            {{-- informasi kontak  --}}
            <h6 class="text-uppercase fw-bold mb-4">
              Hubungi Kami
            </h6>
            <p><span class="iconify" data-icon="akar-icons:instagram-fill" style="font-size: 20px;"></span></i> @duriankupas.id</p>
            <p>
              <span class="iconify" data-icon="ant-design:facebook-outlined" style="font-size: 20px;"></span>
              duriankupas.id
            </p>
            <p><span class="iconify" data-icon="carbon:email" style="font-size: 20px;"></span>
              duriankupasid@mail.com</p>
            <p><span class="iconify" data-icon="akar-icons:phone" style="font-size: 20px;"></span>+6281245657878</p>
          </div>
        </div>
      </div>
    </section>
  
    {{-- copyright --}}
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
      © 2022 Copyright:
      <a class="text-reset fw-bold" href="/">duriankupas.id</a>
    </div>
  </footer>