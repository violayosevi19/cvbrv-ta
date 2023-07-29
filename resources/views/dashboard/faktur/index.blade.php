@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Faktur')
@section('JudulTabel','Faktur')
<div class="ms-4 me-4">
    @if(session()->has('pesan'))
      <div class="alert alert-success d-flex align-items-center alert-faktur text-white" id="alert" role="alert" >
          <div class="flex-grow-1">{{ session('pesan') }}</div>
          <div id="close" class="d-flex justify-content-end close"><i class="fas fa-times"></i></div>
      </div>
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
</div>
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
          @if(auth()->user()->role != "direksi")
          <a href="/faktur-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
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
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pengiriman</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Pembayaran</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Keterangan</th>
                  @if(auth()->user()->role != "direksi")
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  @endif
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
                  @if($faktur->keterangan === "Dalam Pesanan")
                  <div class="btn btn-danger">
                  <span class="text-secondary text-xs font-weight-bold text-white">{{ $faktur->keterangan }}</span>
                  </div>
                  @elseif($faktur->keterangan === "Sedang Diantar")
                  <div class="btn btn-warning">
                  <span class="text-secondary text-xs font-weight-bold text-white">{{ $faktur->keterangan }}</span>
                  </div>
                  @else
                  <div class="btn btn-success">
                  <span class="text-secondary text-xs font-weight-bold text-white">{{ $faktur->keterangan }}</span>
                  </div>
                  @endif
                </td>
                <td class="align-middle text-center">
                  @if($faktur->pembayaran === "kredit")
                  <div class="btn btn-warning">
                  <span class="text-secondary text-xs font-weight-bold text-white">{{ $faktur->pembayaran }}</span>
                  </div>
                  @else
                  <div class="btn btn-success">
                  <span class="text-secondary text-xs font-weight-bold text-white">{{ $faktur->pembayaran }}</span>
                  </div>
                  @endif
                </td>
                <td class="align-middle text-center">
                  @if($faktur->status_diterima == false)
                  <div class="btn btn-danger checked-btn" data-faktur-nonota="{{ $faktur->nonota }}">
                  <span class="text-secondary text-xs font-weight-bold text-white">Belum Bayar</span>
                  </div>
                  @else
                  <div class="btn btn-success" data-faktur-nonota="{{ $faktur->nonota }}">
                  <span class="text-secondary text-xs font-weight-bold text-white">Sudah Bayar</span>
                  </div>
                  @endif
                </td>
                @if(auth()->user()->role != "direksi")
                <td class="align-middle text-center">
                  <a href="/faktur-dash/{{$faktur->id}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                  <form  class="d-inline" action="/faktur-dash/{{ $faktur->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip"  id="delete">
                      Delete
                    </button>
                  </form>
                  <a href="/faktur-dash/{{$faktur->nonota}}" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    // Contoh penggunaan di dalam JavaScript
    $(function () {
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            var form = $(this).closest("form");
            var link = form.attr("action");

            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus?',
                text: "Anda tidak bisa mengembalikan file ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                      type: "POST",
                      url: link,
                      data: form.serialize(),
                      success : function(response){
                          Swal.fire(
                              'Deleted!',
                              'Data sudah dihapus.',
                              'success'
                          ).then(() => {
                              location.reload();
                          });
                      },
                      error : function(xhr,status,error){
                          Swal.fire({
                              icon: 'error',
                              title: 'Oops...',
                              text: error,
                              footer: '<a href="">Why do I have this issue?</a>'
                          });
                      }
                  });
                }
            });
        });

        $(document).on('click','.checked-btn', function() {
            var fakturNonota = $(this).data('faktur-nonota');
            console.log(fakturNonota)
            $.ajax({
              type: 'POST',
              url : '/getpenjualan-cek',
              data : {
                nonota : fakturNonota,
                _token: '{{ csrf_token() }}',
              },
              success: function (response) {
                if (response.success) {
                    // Update warna tombol menjadi hijau (berhasil)
                    $(this).removeClass('btn-danger').addClass('btn-success');

                    // Redirect ke halaman penjualan atau lakukan tindakan lain setelah data berhasil masuk ke tabel penjualan
                    window.location.href = '/penjualan-dash';
                }
              },
              error: function (xhr, status, error) {
                // Tangani kesalahan jika diperlukan
                console.error(error);
              }
            })
        });
    });
    
</script>