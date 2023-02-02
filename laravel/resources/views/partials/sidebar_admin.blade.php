{{-- script/kode untuk tampilan sidebar admin yang ditujukan untuk mengakses menu-menu admin seperti data pemesanan, data reseller.
  data pembeli, data restock, data penarikan uang, data ulasan, dan data produk--}}

    <div class="d-flex flex-column flex-shrink-0 sidebar" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
          <img src="https://i.ibb.co/p3Zft36/logo.png" alt="" class="sidebar-logo">
          <span class="fs-6" style="font-weight: 500; color: #26471d;">duriankupas.id</span>
        </a>
        <hr>
        {{-- informasi singkat  --}}
        <div class="row mt-5">
          <div class="col-3">
            <img src="https://i.postimg.cc/bv3SC2bh/icon1.png" alt="" class="sidebar-ava">
          </div>
          <div class="col">
            <div style="font-weight: 600; font-size: 18px">{{ $dataProfile['username'] }}</div>
            <div>{{ $dataProfile['role'] }}</div>
          </div>
        </div>
        {{-- menu admin  --}}
        <ul class="nav nav-pills flex-column mb-auto" style="margin-top: 60px">
          <li>
            <a href="{{ route('adminDataPemesananView') }}" class="nav-link {{ $title === "Data Pemesanan" ? 'active' : 'link-dark' }}">
                <span class="bi me-2 iconify" data-icon="akar-icons:shopping-bag" style="color: #212427; font-size: 20px;"></span>             
                 Data Pemesanan
            </a>
          </li>
          <li>
            <a href="{{ route('adminDataPembeliView') }}" class="nav-link {{ $title === "Data Pembeli" ? 'active' : 'link-dark' }}">
                <span class="bi me-2 iconify" data-icon="fluent:person-money-20-regular" style="color: #212427; font-size: 20px;"></span>              
                Data Pembeli
            </a>
          </li>
          <li>
            <a href="{{ route('adminDataResellerView') }}" class="nav-link {{ $title === "Data Reseller" ? 'active' : 'link-dark' }}">
                <span class="bi me-2 iconify" data-icon="ant-design:user-outlined" style="color: #212427; font-size: 20px;"></span>              
                Data Reseller
            </a>
          </li>
          <li>
            <a href="{{ route('adminDataRestockView') }}" class="nav-link {{ $title === "Data Restock" ? 'active' : 'link-dark' }}">
              <span class="bi me-2 iconify" data-icon="carbon:product" style="font-size: 20px;"></span>              
              Data Restock
            </a>
          </li>
          <li>
            <a href="{{ route('adminDataTarikUangView') }}" class="nav-link {{ $title === "Data Tarik Uang" ? 'active' : 'link-dark' }}">
              <span class="bi me-2 iconify" data-icon="uil:money-withdrawal" style="font-size: 20px;"></span>              
              Penarikan Uang
            </a>
          </li>
          <li>
            <a href="{{ route('adminDataUlasanPesananView') }}" class="nav-link {{ $title === "Ulasan Pesanan" ? 'active' : 'link-dark' }}">
                <span class="bi me-2 iconify" data-icon="carbon:review"  style="color: #212427; font-size: 20px;"></span>              
                Data Ulasan 
            </a>
          </li>
          <li>
            <a href="{{ route('adminDataProdukView') }}" class="nav-link {{ $title === "Data Produk" ? 'active' : 'link-dark' }}">
                <span class="bi me-2 iconify" data-icon="fluent:table-simple-16-regular" style="color: #212427; font-size: 20px;"></span>              
                Produk
            </a>
          </li>
        </ul>
        {{-- button keluar jika memiliki token  --}}
        @if (!empty(Cookie::get('accessToken')))
          <form action="{{ route('keluar') }}" method="POST" class="inline-block">
              {!! method_field('post') . csrf_field() !!}
              <button type="submit" class="btn btn-keluar">
                  Keluar
              </button>
          </form>
        @endif
    </div>
