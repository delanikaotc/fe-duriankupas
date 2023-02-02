{{-- Berikut merupakan script/kode dari tampilan Nav Bar untuk bernavigasi pada website --}}

{{-- bentuk utama dari navbar --}}
<nav id="scrollspyNav"class="navbar navbar-expand-lg mt-2">
    <div class="container-fluid">
        {{-- logo duriankupas.id --}}
        <a class="navbar-brand" href="/">
            <img src="https://i.ibb.co/p3Zft36/logo.png" alt="" width="30" height="24">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        {{-- halaman-halaman yang ada di duriankupas.id  --}}
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            {{-- halaman produk kami  --}}
            <li class="nav-item">
            <a class="nav-link" href="{{ route('produkView') }}" style="{{ $title == "Produk Kami" ? 'color: #ffc600' : '' }}">Produk Kami</a>
            </li>
            {{-- halaman tentang  --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tentangView') }}" style="{{ $title == "Tentang Kami" ? 'color: #ffc600' : '' }}">Tentang</a>
            </li>
            {{-- halaman bantuan  --}}
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bantuanView') }}" style="{{ $title == "Bantuan" ? 'color: #ffc600' : '' }}">Bantuan</a>
            </li>
            <div class="d-inline">
                @if (!empty(Cookie::get('accessToken')))

            {{-- apabila user diarahkan ke halaman profil user --}}
            @if (Cookie::get('roleUser') == 'user')
            <a href="{{ route('userProfileView') }}" style="{{ $title == "Profil" ? 'color: #ffc600;' : 'color: #26471d;' }} font-weight:600; text-decoration: none;">
            {{-- apabila reseller diarahkan ke dashboard reseller --}}
             @elseif (Cookie::get('roleUser') == 'reseller')
            <a href="{{ route('resellerDashboardView') }}" style="color: #ffc600; font-weight:600; text-decoration: none;">
            {{-- apabila user diarahkan ke halaman data pemesanan pada admin --}}
             @elseif (Cookie::get('roleUser') == 'admin')
            <a href="{{ route('adminDataPemesananView') }}" style="color: #ffc600; font-weight:600; text-decoration: none;">
            @endif
            <div class="d-flex" style="padding-right:16px;">
                <div class="row">
                    <div class="col">
                        <img class="ava-navbar" src="https://i.postimg.cc/bv3SC2bh/icon1.png" alt="">
                    </div>
                    {{-- pengecekan untuk pengambilan data alurnya berbeda apabila dia user baru daftar atau hanya melakukan login --}}
                    @if (empty($data['username']))
                    <div class="col" style="margin-top: 5px">{{ $data['savedUser']['username'] }}</div>
                    @else
                    <div class="col" style="margin-top: 5px">{{ $data['username'] }}</div>     
                    @endif
                </div>
            </div>
        </a>
        @else
        {{-- menampilkan button daftar dan masuk apabila tidak terdeteksi adanya token  --}}
        <div class="d-flex">
            <a class="btn btn-outline-primary me-3" href="{{ route('daftarView') }}" role="button">Daftar</a>
            <a class="btn btn-primary" href="{{ route('masukView') }}" role="button">Masuk</a>
        </div>       
        @endif
            </div>
        </ul>
        </div>
        {{-- perubahan kondisi apabila sudah ada kegiatan daftar/masuk dan memiliki token, button daftar/masuk berganti dengan nama --}}

        {{-- pengecekan role karena setiap role memiliki halaman home masing-masing --}}
        
    </div>
</nav>