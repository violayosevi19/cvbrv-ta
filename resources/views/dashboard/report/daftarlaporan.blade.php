@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Report')
@section('JudulTabel','Report')
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
          <h4>Daftar Laporan Perusahaan</h4>
          <div class="col col-md-3 py-2">
            <div class="d-flex">
            <input type="date" class="form-control" placeholder="masukkan nama bulan">
            <label for="exampleFormControlInput1" class="form-label mt-2 ms-2">s/d</label>
            <input type="date" class="form-control ms-3" placeholder="masukkan nama bulan">
            </div>
            <button type="button" class="btn btn-primary mt-2">Cari</button>
          </div>
        </div>
        <div class="card-body px-6 pt-2 pb-2">
          <div class="table-responsive p-0">
            <table class="table table-bordered align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nomor</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Laporan</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">1</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><a href="{{ url('laporanpenjualan') }}">Laporan Penjualan</a></span>
                </td>
              </tr>
              <tr>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">2</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Laporan Laba Rugi</span>
                </td>
              </tr>
              <tr>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">3</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"> <a href="/cetakstok">Daftar Stock </a></span>
                </td>
              </tr>
              <tr>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">4</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><a href="/cetakproduk">Daftar Produk</a></span>
                </td>
              </tr>
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