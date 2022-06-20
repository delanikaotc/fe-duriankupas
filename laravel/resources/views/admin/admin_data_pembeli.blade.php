@extends('layouts.admin_main')

@section('content')
<div class="content">
    <div class="content-reseller">
        <div class="row justify-content-end mb-5">
            <form class="col-4 d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
        </div>
        <div class="bg">
            <table class="table table-borderless">
                <thead>
                  <tr>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nomor HP</th>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ $item['username'] }}</th>
                        <td>{{ $item['_id'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['phone'] }}</td>
                        <td>Jakarta</td>
                        <td class="row d-flex justify-content-center">
                            <div class="col-2 icon-edit me-1">
                                <a href="">
                                    <span class="iconify" data-icon="clarity:edit-solid" style="color: #f2c94c; font-size: 12px; margin-left: -6px"></span>
                                </a>
                            </div>
                            <div class="col-2">
                            <form action="{{ route('hapusPembeli', $item['_id']) }}" method="post">
                                {!! method_field('post') . csrf_field() !!}
                                <button type="submit" class="btn btn-tolak">
                                    <span class="iconify" data-icon="bi:trash-fill" style="color: #eb5757; font-size: 12px; margin-left: -6px"></span>                            
                                </button>
                            </form>
                                {{-- <a href="{}">
                                    <span class="iconify" data-icon="bi:trash-fill" style="color: #eb5757; font-size: 12px; margin-left: -6px"></span>                            
                                </a> --}}
                            </div>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
    
@endsection