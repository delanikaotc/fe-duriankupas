@extends('layouts.reseller_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        <div class="bg">
            <form action="{{ route('ajukanPenarikan')}}" method="POST">
                {!! method_field('post') . csrf_field() !!}
                <div class="mb-3 row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Nominal Uang</label>
                    <div class="col-sm-10">
                        <input name="jumlah" type="number" class="form-control" id="inputNominalUang" placeholder="Nominal Uang">                   
                     </div>
                </div>
                <div class="mb-3 row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary col-3">Ajukan Penarikan Uang</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
    
@endsection