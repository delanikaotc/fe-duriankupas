
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
        <div class="d-flex">
            <a class="btn btn-outline-primary me-3" href="/daftar" role="button">Daftar</a>
            <a class="btn btn-primary" href="/masuk" role="button">Masuk</a>
        </div>
    </div>
</nav>


