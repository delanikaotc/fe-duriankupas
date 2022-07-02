{{-- script/kode ini adalah untuk tampilan sidebar user yang ditujukan untuk mengakses menu-menu untuk user --}}

<div class="col-2" style="margin-right: 108px;">
    <div class="sidebar-user">
        {{-- informasi singkat mengenai user --}}
        <div class="row">
            <div class="col-3">
                <img class="sidebar-user-avatar" src="https://i.ibb.co/PxPg9Jy/person-icon.png" alt="">
            </div>
            <div class="col">
                <div class="row">
                    @if(!empty($data['username']))
                    <div style="font-weight: 600; font-size: 18px">{{ $data['username'] }}</div>
                    <div>{{ $data['phone'] }}</div>
                    @else
                    <div style="font-weight: 600; font-size: 18px">{{ $data['savedUser']['username'] }}</div>
                    <div>{{ $data['savedUser']['phone'] }}</div>     
                    @endif
                </div>
            </div>
        </div>
        <hr>
        <div>
            {{-- menu yang dapat diakses oleh user --}}
            <div class="sidebar-user-title">Profil Saya</div>
            <div class="sidebar-user-subtitle">
                <div class="mb-1">
                    <a class="{{ $title === "Profil" ? 'active-sidebar-user' : '' }}" href="{{ route('userProfileView') }}">Biodata Diri</a>               
                </div>
                <div>
                    <a href="">Ubah Kata Sandi</a>
                </div>
            </div>
            <div class="sidebar-user-title">Pesanan</div>
            <div class="sidebar-user-subtitle">
                <div class="mb-1">
                    <a class="{{ $title === "Pesanan Saya" ? 'active-sidebar-user' : '' }}" href="{{ route('userPesananView') }}">Daftar Pesanan</a>
                </div>
                {{-- <div>
                    <a href="">Ulasan Pesanan</a>
                </div> --}}
            </div>
            <hr>
            {{-- button untuk keluar --}}
            <div>
                {{-- mengecek apabila ada token dapat melakukan keluar --}}
                @if (!empty(Cookie::get('accessToken')))
                <form action="{{ route('keluar') }}" method="POST" class="inline-block">
                    {!! method_field('post') . csrf_field() !!}
                    <button type="submit" class="btn btn-keluar">
                        Keluar
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>