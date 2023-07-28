@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Toko')
@section('JudulTabel','Toko')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Data Toko</h6>
          @if(auth()->user()->role != "direksi")
          <a href="/toko-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id Toko</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Toko</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Telepon</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Nota</th>
                  @if(auth()->user()->role != "direksi")
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($tokos as $toko)
                <tr>
                 <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $toko->id_toko }}</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $toko->namatoko }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">{{ $toko->alamat }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $toko->notelp }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $toko->email }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $toko->nonota }}</span>
                </td>
                @if(auth()->user()->role != "direksi")
                <td class="align-middle text-center">
                  <a href="/toko-dash/{{$toko->id}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                  <form  class="d-inline" action="/toko-dash/{{ $toko->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" onclick="return confirm('Yakin ingin menghapus data ?')">
                      Delete
                    </button>
                  </form>
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