{{-- script/kode untuk tampilan form unggah bukti kirim uang dari admin --}}

@extends('layouts.admin_main')

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
        <div class="bg mb-4">
            {{-- form untuk unggah bukti kirim uang, apabila disubmit akan menjalankan fungsi uploadbukti dengan id data tarik uang --}}
            <form action="{{ route('uploadBukti', $dataTarikUang['_id']) }}" method="post" enctype="multipart/form-data">
            {!! method_field('post') . csrf_field() !!}
            <div style="text-align: left;">
                <div class="mb-3 row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Bukti Kirim Uang</label>
                    <div class="col-sm-10">
                        <input name="image" type="file" class="form-control-file" id="inputBuktiPembayaran">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- button unggah bukti untuk submit gambar yang dikirim --}}
            <div class="col d-flex justify-content-end" style="margin-left: -24px">
              <button type="submit" class="btn btn-primary">Unggah Bukti</button>    
            </div>
        </div>
    </form>
    </div>
</div>
    
@endsection