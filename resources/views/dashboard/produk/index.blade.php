@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Produk')
@section('JudulTabel','Produk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Data Produk</h6>
          @if(auth()->user()->role != "direksi")
          <a href="/produk-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Produk</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Produk</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Produk</th>
                  @if(auth()->user()->role != "direksi")
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($produks as $produk)
                <tr>
                 <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm"><a href="/supplier-dash/{{$produk->kodeproduk}}">{{ $produk->kodeproduk }}</a></h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $produk->namaproduk }}</p>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $produk->harga }}</span>
                </td>
                @if($produk->jenisproduk !== null)
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $produk->jenisproduk->jenis }}</span>
                </td>
                @else
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"></span>
                </td>
                @endif
                @if(auth()->user()->role != "direksi")
                <td class="align-middle text-center">
                  <a href="/produk-dash/{{$produk->id}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                  <form  class="d-inline" action="/produk-dash/{{ $produk->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" onclick="return confirm('Yakin ingin menghapus data ?')">
                      Delete
                    </button>
                  </form>
                  <a href="/produk-dash/{{$produk->id}}" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Read
                  </a>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@if(session()->has('pesan'))
<div class="alert alert-danger" role="alert">
  {{ session('pesan') }}
</div>
@endif
@endsection