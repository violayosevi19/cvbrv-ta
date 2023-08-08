@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Pegawai')
@section('JudulTabel','Pegawai')
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
          <h4 class="text-center">Data Pegawai</h4>
          @if(auth()->user()->role != "direksi")
          <a href="/pegawai-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="myTable" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Id Pegawai</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Pegawai</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Lahir</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Kelamin</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tamatan</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jabatan</th>
                  @if(auth()->user()->role != "direksi")
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach($pegawais as $pegawai)
                <tr>
                 <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ $pegawai->idpegawai }}</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ $pegawai->nama }}</p>
                </td>
                <td class="align-middle text-center text-sm">
                  <span class="badge badge-sm bg-gradient-secondary">{{ $pegawai->tgllahir }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $pegawai->jekel }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $pegawai->alamat }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $pegawai->tamatan }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $pegawai->jabatan }}</span>
                </td>
                @if(auth()->user()->role != "direksi")
                <td class="align-middle text-center">
                  <a href="/pegawai-dash/{{$pegawai->id}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                  <form  class="d-inline" action="/pegawai-dash/{{ $pegawai->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button id="delete" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip">
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
<footer class="footer pt-3  ">
  <div class="container-fluid">
    <div class="row align-items-center justify-content-lg-between">
      <div class="col-lg-6 mb-lg-0 mb-4">
        <div class="copyright text-center text-sm text-muted text-lg-start">
          © <script>
            document.write(new Date().getFullYear())
          </script>,
          made with <i class="fa fa-heart"></i> by
          <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
          for a better web.
        </div>
      </div>
      <div class="col-lg-6">
        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
          <li class="nav-item">
            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
          </li>
          <li class="nav-item">
            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
          </li>
        </ul>
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