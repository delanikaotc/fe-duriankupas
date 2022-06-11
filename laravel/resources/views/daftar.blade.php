@extends('layouts.main')

@section('content')
<div class="content masuk" style="margin-bottom: 60px">
    <div class="title-page">
        <h1 style="font-weight: 600pxs">Daftar</h1>
    </div>
    <div class="sub-content">
        <div class="card-masuk">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-4">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="row d-flex justify-content-center mb-4" style="width:375px; margin-left: 0px">
                <button type="button" class="btn btn-primary">Daftar</button>    
            </div>
            <div style="margin-bottom:80px;">
                <p style="text-align: center; font-weight: 400px; font-size: 14px">Dengan mendaftar, saya menyetujui <br>
                Syarat dan Ketentuan serta Kebijakan Privasi</p>
            </div>
            <div class="sudah-punya-akun">
                <p style="text-align: center; font-weight: 400px; font-size: 14px">Sudah punya akun? 
                    <a href="">Masuk</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection