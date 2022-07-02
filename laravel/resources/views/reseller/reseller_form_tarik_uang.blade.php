{{-- script/kode untuk tampilan form tarik uang --}}
@extends('layouts.reseller_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        @if ($errors->any())
        <div class="sub-content">
            <div class="alert alert-danger" role="alert">
                {{ $errors->first() }}
            </div>
        </div>
        @endif
        <div class="bg">
            {{-- form apabil disubmit akan menjalankan fungsi ajukanpenarikan dengan metode post --}}
            <form action="{{ route('ajukanPenarikan')}}" method="POST">
                {!! method_field('post') . csrf_field() !!}
                <div class="mb-3 row">
                    {{-- mengajukan nominal uang yang ingin ditarik --}}
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nominal Uang</label>
                    <div class="col-sm-10">
                        <input name="jumlah" type="text" class="form-control" id="inputNominalUang" placeholder="Nominal Uang">                   
                     </div>
                </div>
                <div class="mb-3 row">
                    {{-- button submit untuk mengajukan penarikan uang --}}
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary col-3">Ajukan Penarikan Uang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection