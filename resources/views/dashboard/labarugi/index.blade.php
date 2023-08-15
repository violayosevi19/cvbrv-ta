@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Laba Rugi')
@section('JudulTabel','Laba Rugi')
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
          <h4>Data Pengeluaran</h4>
          @if(auth()->user()->role != "direksi")
          <a href="/labarugi-dash/create" class="btn btn-primary">Tambah Data</a>
          @endif
          <a href="/labarugi" target="_blank" class="btn btn-success fa-lg"><i class="fas fa-print"></i></a>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-3">
            <table id="myTable" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="3">Mulai</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"  rowspan="3">Akhir</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"  rowspan="3">Gaji</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="4">Biaya</th>
                  
                  @if(auth()->user()->role != "direksi")
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" rowspan="3">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ATK</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Operasional</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Listrik</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Internet</th>
                </tr>
              </thead>
              <tfoot>
               
              </tfoot>
              <tbody>
                @if($labarugis !== "undefined")
                @foreach($labarugis as $value)
                <tr>
                 <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">{{ date('d-m-Y', strtotime($value->tglmulai)) }}</h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0">{{ date('d-m-Y', strtotime($value->tglakhir)) }}</p>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Rp{{ number_format($value->gajikaryawan, 0, ',', '.') }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Rp{{ number_format($value->biayaATK, 0, ',', '.') }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Rp{{ number_format($value->biayaoperasional, 0, ',', '.') }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Rp{{ number_format($value->biayalistrik, 0, ',', '.') }}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Rp{{ number_format($value->biayainternet, 0, ',', '.') }}</span>
                </td>
                @if(auth()->user()->role != "direksi")
                <td class="align-middle text-center">
                  <a href="/labarugi-dash/{{$value->id}}/edit" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                    Edit
                  </a>
                  <form  class="d-inline" action="/labarugi-dash/{{ $value->id }}" method="post">
                    @method('delete')
                    @csrf
                    <button class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" id="delete">
                      Delete
                    </button>
                  </form>
                  <a href="/labarugi-dash/{{$value->id}}/cetak" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                  <i class="fas fa-print fs-l"></i>
                  </a>
                </td>
                @endif
              </tr>
              @endforeach
              @else
              <tr>
                 <td>
                  <div class="d-flex px-2 py-1">
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="mb-0 text-sm"></h6>
                    </div>
                  </div>
                </td>
                <td>
                  <p class="text-xs font-weight-bold mb-0"></p>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"></span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"></span>
                </td>
                <td class="align-middle text-center">
                  
                </td>
              </tr>
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4>Daftar Laporan Perusahaan</h4>
        </div>
        <div class="row mt-2">
          <div class="col">
            <div class="input-group ms-3">
              <span class="input-group-text">Pilih Tanggal</span>
              <input type="date" aria-label="Tanggal Awal" class="form-control" name="tglawal" id="tglawal">
              <input type="date" aria-label="Tanggal Akhir" class="form-control" name="tglakhir" id="tglakhir">
            </div>
          </div>
          <div class="col">
            <div class="input-group-append">
              <a href="#" 
              onclick="this.href='/get-data-report/' + document.getElementById('tglawal').value + '/' + document.getElementById('tglakhir').value"
              target="_blank" 
              class="btn btn-info">Cetak</a>
            </div>
          </div>
        </div>
        <div class="card-body px-6 pt-2 pb-2 mt-4">
          <div class="table-responsive p-0">
            <table id="tabelReport" class="table table-bordered align-items-center mb-0">
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
                  <span class="text-secondary text-xs font-weight-bold"><a href="{{ url('laporanpenjualan') }}">Laporan Penjualan Keseluruhan</a></span>
                </td>
              </tr>
              <tr>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">2</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold"><a href="{{ url('labarugi') }}">Laporan Laba Rugi</a></span>
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
 $(document).ready(function () {
      $('#tabelReport').DataTable({
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
  $('#tabelReport').parent().css('text-align', 'right');
    $('.dataTables_length label .form-select').css({
      'padding-right': '20px',
      'white-space': 'nowrap',
      'width' : '30%'
    });
    $('#tabelReport_info').css({
      'font-family': 'Open Sans, sans-serif',
      'font-size' : '12px'
    });
    $('.dataTables_paginate .pagination .active .page-link').css('color', 'white');
});
</script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#myTable').DataTable({
      paging: true,
      pageLength: 10,
      lengthMenu: [
          [10, 25, 50, -1],
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
  });
</script>
