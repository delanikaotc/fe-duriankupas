{{-- <main> --}}
    <div class="d-flex flex-column flex-shrink-0 sidebar" style="width: 280px;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
          <img src="https://i.ibb.co/p3Zft36/logo.png" alt="" class="sidebar-logo">
          <span class="fs-6" style="font-weight: 500; color: #26471d;">duriankupas.id</span>
        </a>
        <hr>
        <div class="row mt-5">
          <div class="col-3">
            <img src="https://i.ibb.co/PxPg9Jy/person-icon.png" alt="" class="sidebar-ava">
          </div>
          <div class="col">
            <div style="font-weight: 600; font-size: 18px">{{ $dataProfile['username'] }}</div>
            <div>{{ $dataProfile['role'] }}</div>
          </div>
        </div>
        <ul class="nav nav-pills flex-column mb-auto" style="margin-top: 60px">
          <li>
            <a href="{{ route('resellerDashboardView') }}" class="nav-link {{ $title === "Dashboard" ? 'active' : 'link-dark' }}" aria-current="page">
              <span class="bi me-2 iconify" data-icon="fluent:home-16-regular" style="font-size: 20px;"></span>              
              Dashboard
            </a>
          </li>
          <li>
            <a href="{{ route('resellerDataPemesananBaruView') }}" class="nav-link {{ $title === "Data Pemesanan" ? 'active' : 'link-dark' }}">
              <span class="bi me-2 iconify" data-icon="bi:table" style="font-size: 20px;"></span>              
              Data Pemesanan
            </a>
          </li>
          <li>
            <a href="{{ route('resellerDataRestockView') }}" class="nav-link {{ $title === "Data Restock" ? 'active' : 'link-dark' }}">
              <span class="bi me-2 iconify" data-icon="carbon:product" style="font-size: 20px;"></span>              
              Request Restock
            </a>
          </li>
          <li>
            <a href="{{ route('resellerDataTarikUangView') }}" class="nav-link {{ $title === "Data Tarik Uang" ? 'active' : 'link-dark' }}">
              <span class="bi me-2 iconify" data-icon="uil:money-withdrawal" style="font-size: 20px;"></span>              
              Penarikan Uang
            </a>
          </li>
        </ul>
        @if (!empty(Cookie::get('accessToken')))
          <form action="{{ route('keluar') }}" method="POST" class="inline-block">
              {!! method_field('post') . csrf_field() !!}
              <button type="submit" class="btn btn-keluar">
                  Keluar
              </button>
          </form>
        @endif
        {{-- <div class="row">
          <a href="" style="color: #EB5757; text-decoration: none; text-align: center;">Keluar</a>
        </div> --}}
    </div>
{{-- </main> --}}