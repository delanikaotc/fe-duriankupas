@extends('layouts.main')

@section('content')
<div class="content masuk" style="margin-bottom: 60px">
    <div class="title-page">
        <h1 style="font-weight: 600pxs">Masuk</h1>
    </div>
    <div class="sub-content">
        <div class="card-masuk">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-4">
                <label for="exampleFormControlInput1" class="form-label">Kata Sandi</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                <a href="" class="d-flex justify-content-end" style="color: #212427; font-size: 14px">Lupa kata sandi?</a>
            </div>
            <div class="row d-flex justify-content-center mb-4" style="width:375px; margin-left: 0px; margin-bottom:80px;">
                <button type="button" class="btn btn-primary">Masuk</button>    
            </div>
            <div>
                <p style="text-align: center; font-weight: 400px; font-size: 14px; font-weight: 500;">Belum punya akun? 
                    <a href="">Daftar</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection