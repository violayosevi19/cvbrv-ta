@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Detail Orderan')
@section('JudulTabel','Detail Orderan')
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
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
        <h4 class="mx-3 text-center">Detail Orderan</h4>
          @if(auth()->user()->role != "direksi")
          <a href="/detailorderan-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="myTable" class="table align-items-center mb-0">
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
                 <span class="text-secondary text-xs font-weight-bold"><a href="/faktur-dash/create?nonota={{ $detail['nonota']}}">{{ $detail['nonota']}}</a></span>
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
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" id="delete">
                      Delete
                    </button>
                  </form>
                  <a href="/detailorderan-dash/{{$detail['nonota']}}" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Read
                  </a>
                  <a href="/return-dash/{{$detail['nonota']}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                   Return
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