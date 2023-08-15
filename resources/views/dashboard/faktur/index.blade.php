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
        <h4 class="mx-3 text-center">Daftar Faktur</h4>
          @if(auth()->user()->role != "direksi")
          <a href="/detailorderan-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="myTable" class="table align-items-center mb-0">
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
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Bukti</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diterima Pada</th>
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
                  <p class="text-xs font-weight-bold mb-0">{{ date('d-m-Y', strtotime($faktur->tglfaktur ))}}</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">{{ date('d-m-Y', strtotime($faktur->jatuhtempo)) }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Rp{{ number_format($faktur->total, 0, ',', '.') }}</span>
                </td>
                <td class="align-middle text-center">
                  <img src="{{ asset('storage/test/' . $faktur->file) }}" class="img-fluid text-secondary text-xs font-weight-bold" alt="bukti">
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
                  @if($faktur->pembayaran === "Kredit")
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
                  <div class="btn btn-danger checked-btn" data-faktur-nonota="{{ $faktur->nonota }}" data-faktur-total="{{ $faktur->total }}">
                  <span class="text-secondary text-xs font-weight-bold text-white">Belum Bayar</span>
                  </div>
                  @else
                  <div class="btn btn-success done-btn" data-faktur-nonota="{{ $faktur->nonota }}" data-faktur-total="{{ $faktur->total }}" data-faktur-penerima="{{ $faktur->penerima }}" data-faktur-diterimapada="{{ $faktur->diterimapada }}">
                  <span class="text-secondary text-xs font-weight-bold text-white">Sudah Bayar</span>
                  </div>
                  @endif
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ date('d-m-Y', strtotime($faktur->diterimapada)) }}</span>
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
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Input Bukti dan Total</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/getpenjualan-cek" enctype="multipart/form-data" method="POST">
              @csrf
              <div class="modal-body">
                      <input type="hidden" id="nonotaInput" name="nonota" value="">
                      <div class="form-group">
                          <label for="buktiInput">Bukti Transaksi:</label>
                          <input type="file" class="form-control" id="buktiInput" name="buktiInput">
                      </div>
                      <div class="form-group">
                          <label for="totalInput">Penerima</label>
                          <input type="text" class="form-control" id="penerima" name="penerima">
                      </div>
                      <div class="form-group">
                          <label for="totalInput">Total Diterima:</label>
                          <input type="number" class="form-control" id="totalInput" name="totalInput" value="">
                      </div>
                      <div class="form-group">
                          <label for="totalInput">Diterima Pada:</label>
                          <input type="date" class="form-control" id="diterimapada" name="diterimapada">
                      </div>
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary" id="submitModal">Submit</button>
                  <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
              </div>
            </form>
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

        $(document).on('click', '.checked-btn', function() {
          var fakturNonota = $(this).data('faktur-nonota')
          var fakturTotal = $(this).data('faktur-total')
          console.log(fakturNonota,fakturTotal)
          $('#nonotaInput').val(fakturNonota);
          $('#totalInput').val(fakturTotal);
             
          $('#modal').modal('show'); // Gantikan '#modal' dengan ID modal Anda
       });

       $(document).on('click', '.done-btn', function() {
          var fakturNonota = $(this).data('faktur-nonota')
          var fakturTotal = $(this).data('faktur-total')
          var fakturpenerima = $(this).data('faktur-penerima')
          var fakturditerima = $(this).data('faktur-diterimapada')
          console.log(fakturNonota,fakturTotal)
          $('#nonotaInput').val(fakturNonota);
          $('#totalInput').val(fakturTotal);
          $('#penerima').val(fakturpenerima);
          $('#diterimapada').val(fakturditerima);
             
          $('#modal').modal('show'); // Gantikan '#modal' dengan ID modal Anda
       });

       $('.close').on('click', function() {
            $('#buktiInput').val('');
            $('#totalInput').val('');
            $('#modal').modal('hide'); 
          });

    });
    
</script>
<script type="text/javascript">
    // Contoh penggunaan di dalam JavaScript
    $(function () {
        $(document).on('click', '#delete', function (e) {
            e.preventDefault();
            var form = $(this).closest("form");
            var link = form.attr("action");

            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                  $.ajax({
                      type: "POST",
                      url: link,
                      data: form.serialize(),
                      success : function(response){
                          Swal.fire(
                              'Deleted!',
                              'Data Anda sudah dihapus.',
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
    });
</script>
<script type="text/javascript">
 $(document).ready(function () {
      $('#myTable').DataTable({
      paging: true,
      pageLength: 10,
      // scrollX:true,
      lengthMenu: [
          [20, 25, 50, -1],
          [10, 25, 50, "All"]
      ],
      language: {
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
          infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
          infoFiltered: "(disaring dari _MAX_ total data)",
          lengthMenu: "Tampilkan _MENU_ data per halaman",
          zeroRecords: "Tidak ada data yang cocok",
          search: "Cari:",
          paginate: {
              first: "Pertama",
              last: "Terakhir",
              next: ">",
              previous: "<"
          }
      }
  });
  $('#myTable').parent().css('text-align', 'right');
    $('.dataTables_length label .form-select').css({
      'padding-right': '20px',
      'white-space': 'nowrap',
      'width' : '30%'
    });
    $('#myTable_info').css({
      'font-family': 'Open Sans, sans-serif',
      'font-size' : '12px'
    });
    $('.dataTables_paginate .pagination .active .page-link').css('color', 'white');
});
 
</script>