@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Supplier')
@section('JudulTabel','Supplier')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Data Supplier</h6>
          @if(auth()->user()->role != "direksi")
          <a href="/supplier-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Nota</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Supplier</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Produk</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Hp</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Faktur</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jatuh Tempo</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                  @if(auth()->user()->role != "direksi")
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($suppliers as $sp)
                <tr>
                <td class="align-middle text-center">
                  <span class="badge badge-sm bg-gradient-secondary">{{ $sp->nonota }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $sp->namasupplier }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $sp->kodeproduk }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $sp->nohp }}</span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="text-secondary text-xs font-weight-bold">{{ $sp->tglfaktur }}</span>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">{{ $sp->jatuhtempo }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $sp->total }}</span>
                </td>
                @if(auth()->user()->role != "direksi")
                <td class="align-middle text-center">
                  <a href="/supplier-dash/{{$sp->id}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                  <form  class="d-inline" action="/supplier-dash/{{ $sp->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" onclick="return confirm('Yakin ingin menghapus data ?')">
                      Delete
                    </button>
                  </form>
                  <a href="/supplier-dash/{{$sp->kodeproduk}}" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
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