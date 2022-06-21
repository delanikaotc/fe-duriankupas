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
                    <form action="{{ route('kirimUlasan', $data['_id'])  }}" method="POST">
                        {!! method_field('post') . csrf_field() !!}
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Rating</label>
                            <div class="col-sm-3">
                                <select name="rating" class="form-select form-select-sm" aria-label=".form-select-sm example">
                                    <option selected>Pilih Rating</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Ulasan</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Beri Ulasan" name="review" class="form-control form-control-sm" id="inputReview" rows="2" style="resize: none"></textarea>                            
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary col-2">Kirim</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection