@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Faktur')
@section('JudulTabel','Faktur')
<div class="ms-4 me-4">
  @if(!empty($alertJatuhTempo))
      @foreach($alertJatuhTempo as $message)
      <div class="alert alert-danger d-flex align-items-center" id="alert" class="alert-faktur" role="alert" >
          <div class="flex-grow-1">{{$message}}</div>
          <div id="close" class="d-flex justify-content-end close"><i class="fas fa-times"></i></div>
      </div>
    @endforeach
    @endif
    <script>
      var closeElement = document.querySelectorAll('.close');
      closeElement.forEach(function(close) {
          close.addEventListener('click', function() {
            var closeContent = document.getElementById('alert');
            console.log(closeContent);
              if (closeContent) {
                closeContent.remove();
              }
          })
      });
    </script>
    <style>
      #alert {
        background-color: rgba(255, 0, 0, 0.5); /* Ganti angka 0.5 sesuai dengan tingkat transparansi yang diinginkan (0-1) */
        color:white;
      }
    </style>
    </div>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6>Data Faktur</h6>
          <a href="/faktur-dash/create" class="btn btn-primary">Tambah Data</a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Nota</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Toko</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Faktur</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jatuh Tempo</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($fakturs as $faktur)
                <tr>
                 <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $faktur->nonota }}</h6>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $faktur->namatoko }}</span>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $faktur->tglfaktur }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">{{ $faktur->jatuhtempo }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $faktur->total }}</span>
                </td>
                <td class="align-middle text-center">
                  @if($faktur->keterangan === "ordered")
                  <div class="btn btn-warning">
                  <span class="text-secondary text-xs font-weight-bold text-white">{{ $faktur->keterangan }}</span>
                  </div>
                  @elseif($faktur->keterangan === "shipping")
                  <div class="btn btn-primary">
                  <span class="text-secondary text-xs font-weight-bold text-white">{{ $faktur->keterangan }}</span>
                  </div>
                  @else
                  <div class="btn btn-success">
                  <span class="text-secondary text-xs font-weight-bold text-white">{{ $faktur->keterangan }}</span>
                  </div>
                  @endif
                </td>
                <td class="align-middle text-center">
                  <a href="/faktur-dash/{{$faktur->id}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                  <form  class="d-inline" action="/faktur-dash/{{ $faktur->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" onclick="return confirm('Yakin ingin menghapus data ?')">
                      Delete
                    </button>
                  </form>
                  <a href="/faktur-dash/{{$faktur->nonota}}" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Read
                  </a>
                </td>
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
<div class="alert alert-danger" id="alert-update" role="alert">
  {{ session('pesan') }}
</div>
@endif
<script>
  setTimeout(() => {
    const alert = document.getElementById('alert-update');
    alert.style.display = "none";
  }, 3000);
</script>
@endsection