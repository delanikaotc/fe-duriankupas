@extends('layouts.user_main')

@section('content')
    <div class="content">
        <div class="title-page">
            <h1 style="font-weight: 600">Ulasan Pesanan</h1>
        </div>
        <div class="row">
            @include('partials.sidebar_user')
            <div class="col">
                <div class="bg-user">
                    <div class="col-6 mb-4">
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="row">
                        <div class="card-pesanan">
                            <div class="mb-4">
                                <div class="card-pesanan-title">Pesanan #12345JKT</div>
                                <div>7 April 2022</div>
                            </div>
                            <div>
                                <div>Pesanan memuaskan, cepat sampai!</div>
                            </div>
                        </div>
                        <div class="card-pesanan">
                            <div class="mb-4">
                                <div class="card-pesanan-title">Pesanan #12345JKT</div>
                                <div>7 April 2022</div>
                            </div>
                            <div>
                                <div>Pesanan memuaskan, cepat sampai!</div>
                            </div>
                        </div>
                        <div class="card-pesanan">
                            <div class="mb-4">
                                <div class="card-pesanan-title">Pesanan #12345JKT</div>
                                <div>7 April 2022</div>
                            </div>
                            <div>
                                <div>Pesanan memuaskan, cepat sampai!</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection