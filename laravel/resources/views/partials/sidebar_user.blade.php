<div class="col-2" style="margin-right: 108px;">
    <div class="sidebar-user">
        <div class="row">
            <div class="col-3">
                <img class="sidebar-user-avatar" src="{{ asset('images/icon1.png') }}" alt="">
            </div>
            <div class="col">
                <div class="row">
                    <div style="font-weight: 600; font-size: 18px">{{ $data['username'] }}</div>
                    <div>#ID123467JKT</div>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <div class="sidebar-user-title">Profil Saya</div>
            <div class="sidebar-user-subtitle">
                <div class="mb-1">
                    <a class="{{ $title === "Profil" ? 'active-sidebar-user' : '' }}" href="{{ route('userProfileView') }}">Biodata Diri</a>               
                </div>
                <div>
                    <a href="/user">Ubah Kata Sandi</a>
                </div>
            </div>
            <div class="sidebar-user-title">Pesanan</div>
            <div class="sidebar-user-subtitle">
                <div class="mb-1">
                    <a class="{{ $title === "Pesanan Saya" ? 'active-sidebar-user' : '' }}" href="{{ route('userPesananView') }}">Daftar Pesanan</a>
                </div>
                <div>
                    <a href="/ulasan">Ulasan Pesanan</a>
                </div>
            </div>
            <hr>
            <div>
                @if (!empty(Cookie::get('accessToken')))
                <form action="{{ route('keluar') }}" method="POST" class="inline-block">
                    {!! method_field('post') . csrf_field() !!}
                    <button type="submit" class="btn btn-keluar">
                        Keluar
                    </button>
                </form>
                @endif
                {{-- <a href="" style="text-decoration: none; color: #EB5757">Keluar</a> --}}
            </div>
            {{-- <div class="sidebar-user-title">Gabung Reseller</div>
            <div class="sidebar-user-subtitle">
                <div>
                    <a href="/gabung-reseller">Form Reseller</a>
                </div>
            </div> --}}
        </div>
    </div>
</div>