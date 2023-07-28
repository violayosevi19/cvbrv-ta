@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Detail Orderan')
@section('JudulTabel','Detail Orderan')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      @if(session()->has('pesan'))
          <div class="alert alert-danger" role="alert">
            {{ session('pesan') }}
          </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif  
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Detail Orderan</h6>
          @if(auth()->user()->role != "direksi")
          <a href="/detailorderan-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Nota</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Toko</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Faktur</th>
                  @if(auth()->user()->role != "direksi")
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($detailtokos as $detail)
                <tr>
                 <td class="align-middle text-center">
                 <span class="text-secondary text-xs font-weight-bold">{{ $detail['nonota']}}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $detail['namatoko']}}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $detail['alamat']}}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $detail['tglfaktur']}}</span>
                </td>
                @if(auth()->user()->role != "direksi")
                <td class="align-middle text-center">
                  <a href="/detailorderan-dash/{{$detail['nonota']}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                   Edit
                  </a>
                  <form  class="d-inline" action="/detailorderan-dash/{{ $detail['nonota'] }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" onclick="return confirm('Yakin ingin menghapus data ?')">
                      Delete
                    </button>
                  </form>
                  <a href="/detailorderan-dash/{{$detail['nonota']}}" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
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
@endsection