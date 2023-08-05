@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Produk')
@section('JudulTabel','Produk')
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
    @if(session()->has('error'))
      <div class="alert alert-danger d-flex align-items-center alert-faktur text-white" id="alert" role="alert" >
          <div class="flex-grow-1">{{ session('error') }}</div>
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
          <h6>Data Produk</h6>
          @if(auth()->user()->role != "direksi")
          <a href="/produk-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
          <a href="/cetakproduk" class="btn btn-success fa-lg"><i class="fas fa-print"></i></a>
        </div>
        <div id="searchResults"></div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="myTable" class="table align-items-center mb-0 px-3 py-3 display">
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
                      <h6 class="mb-0 text-sm"><a href="/produk-dash/{{$produk->kodeproduk}}">{{ $produk->kodeproduk }}</a></h6>
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
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" id="delete">
                      Delete
                    </button>
                  </form>
                  <a href="/produk-dash/{{$produk->kodeproduk}}" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
    $('.dataTables_paginate .pagination .active .page-link').css('color', 'white');
});
 
</script>