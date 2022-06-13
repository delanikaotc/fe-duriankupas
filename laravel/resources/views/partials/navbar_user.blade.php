
<nav id="scrollspyNav"class="navbar navbar-expand-lg mt-2">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="" width="30" height="24">
        </a>
        <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link {{ $title === "produk" ? 'active' : '' }}" href="/produk">Produk</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Tentang</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#">Bantuan</a>
            </li>
        </ul>
        </div>
        <div class="d-flex" style="padding-right:96px">
            <div class="row">
                <div class="col">
                    <img class="ava-navbar" src="{{ asset('images/icon1.png') }}" alt="">
                </div>
                <div class="col" style="margin-top: 5px"><a href="/user" style="color: #26471D; font-weight:600; text-decoration: none;">Yunita</a></div>
            </div>
        </div>
    </div>
</nav>


