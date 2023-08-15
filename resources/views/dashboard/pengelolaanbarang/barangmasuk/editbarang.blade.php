@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Barang Masuk')
@section('JudulTabel','Barang Masuk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4 class="mx-3 text-center">Edit Barang Masuk</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-3 mt-3">
                @foreach($detailfaktur as $detail)
              <form action="/barangmasuk-dash/{{ $detail['nonota'] }}" method="post">
                @csrf
                @method('put')
              <div class="row">
              <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Supplier</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control" placeholder="Enter nama supplier" name="namasupplier" value="{{ $detail['namasupplier'] }}">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class="align-middle  text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Faktur</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="date" class="form-control" placeholder="Enter tanggal faktur" name="tanggalmasuk" value="{{ $detail['tanggalmasuk'] }}">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Nota</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control" placeholder="Enter nofaktur" name="nonota" value="{{ $detail['nonota'] }}">
                            </td>
                        </tr>
                    </table>
                </div>
              </div>
              @endforeach
              <div class="row">
                <div class="col">
                  <h4 class="mx-3 text-center mt-4">FAKTUR PENJUALAN</h4>
                </div>
              </div>
              <div class="col mt-3 justify-content-center produk-div">
              <div class="col col-md-4">
                  <button type="button" class="btn btn-warning btn-view" data-toggle="modal" data-target="#productModal">Cek Produk</button>
                </div>
                    <table class="table">
                        <thead>
                            <tr>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Produk</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qty(pcs)</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Qty(lsn/krtn)</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diskon</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailproduks as $index => $details)
                            <tr>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control kodeproduk" id="kodeproduk{{$index}}"  name="inputs[{{$index}}][kodeproduk]" placeholder="Enter kode produk" value="{{ $details['kodeproduk'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control namaproduk" id="namaproduk{{$index}}"  name="inputs[{{$index}}][namaproduk]" placeholder="Enter nama produk" value="{{ $details['namaproduk'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="number" class="form-control kuantitas" id="kuantitas{{$index}}" name="inputs[{{$index}}][stock]" placeholder="Enter kuantitas" value="{{ $details['stock'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control satuan" id="satuan{{$index}}" name="inputs[{{$index}}][satuan]" placeholder="Enter satuan" value="{{ $details['satuan'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="number" class="form-control harga" id="harga{{$index}}"  name="inputs[{{$index}}][harga]" placeholder="Enter harga produk" value="{{ $details['harga'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <div class="input-group">
                                  <input type="text" class="form-control diskon" id="diskon{{$index}}" name="inputs[{{$index}}][diskon]" placeholder="Enter diskon" value="{{ $details['diskon'] }}">
                                  <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control jumlah" id="jumlah{{$index}}"  name="inputs[{{$index}}][jumlah]" placeholder="Enter jumlah" value="{{ $details['jumlah'] }}">
                              </td>
                              @endforeach
                              <td class="align-middle text-center">
                                <button class="btn btn-success mt-3" type="button" name="add" id="add">Tambah</button>
                              </td>
                            </tr>
                        </tbody>
                      </table>
                    <button class="btn btn-primary mt-3" type="submit" name="submit" id="submit">Submit</button>
                 </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Daftar Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="table-responsive p-3">
          <div class="col col-md-6">
            <input type="text" class="form-control" id="searchInput" placeholder="Cari...">
          </div>
        <table id="tableProduct" class="table">
          <thead>
              <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Kode Produk</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 text-center">Nama Produk</th>
              </tr>
            </thead>
          <tbody>
            @foreach($produks as $item)
            <tr>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $item->kodeproduk}}</span>
                </td>
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $item->namaproduk}}</span>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  @endsection
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
        const totalData = {!! $totaldatapernota !!};
        let counter = totalData;
        console.log(counter);
        $('#add').on('click',function() {
            // Menambahkan baris input baru ke dalam tabel
            function addNewRow(){
                // counter++;
                const newRow = `
                <tr>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="kodeproduk"  name="inputs[`+counter+`][kodeproduk]" placeholder="Enter kode produk">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="namaproduk" name="inputs[`+counter+`][namaproduk]" placeholder="Enter nama produk">
                    </td>
                    <td class="align-middle text-center">
                    <input type="number" class="form-control" id="kuantitas" name="inputs[`+counter+`][stock]" placeholder="Enter kuantitas">
                    </td>
                    <td class="align-middle text-center">
                      <input type="text" class="form-control satuan " id="satuan" name="inputs[`+counter+`][satuan]" placeholder="Enter banyaknya">
                    </td>
                    <td class="align-middle text-center">
                    <input type="number" class="form-control" id="harga" name="inputs[`+counter+`][harga]" placeholder="Enter harga">
                    </td>
                    <td class="align-middle text-center">
                      <div class="input-group">
                        <input type="text" class="form-control" id="diskon" name="inputs[`+counter+`][diskon]" placeholder="Enter disc">
                          <span class="input-group-text" id="basic-addon1">%</span>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="jumlah" name="inputs[`+counter+`][jumlah]" placeholder="Enter jumlah">
                    </td>
                    <td class="align-middle text-center">
                    <button class="btn btn-danger mt-3" type="button" name="remove" id="remove">Remove</button>
                    </td>
                </tr>
                `;
                $('form .produk-div .table tbody').append(newRow);
            }
            addNewRow();
            counter++;

            $(document).on('click','#remove', function () {
              $(
                this).parents('tr').remove();
            })

            // Reset nilai input setelah menambahkan baris baru
            $('input[name="kodeproduk"]').val('');
            $('input[name="namaproduk"]').val('');
            $('input[name="stock"]').val('');
            $('input[name="harga"]').val('');
            $('input[name="diskon"]').val('');
            $('input[name="jumlah"]').val('');
          });

          $('.close').on('click', function() {
            $('#productModal').modal('hide'); 
          });
    });

    $(document).on('input','#kodeproduk', function() {
              var kodeproduk = $(this).val();
              var namaprodukField = $(this).closest('tr').find('#namaproduk');
              var harga = $(this).closest('tr').find('#harga');
              if(kodeproduk !== '') {
                $.ajax({
                  url:'/get-produk',
                  type: 'GET',
                  data : { kodeproduk : kodeproduk },
                  success : function (response) {
                    namaprodukField.val(response.namaproduk)
                    harga.val(response.hargaproduk)
                  },
                  error: function(xhr, status, error) {
                      // Handle the error response
                      console.log('Error:', error);
                  }
                })
              } else {
                $('#namaproduk').val('');
                $('#harga').val('');
              }
    });

    $(document).on('input', '.kodeproduk', function() {
      var kodeproduk = $(this).val();
      var currentRow = $(this).closest('tr');
      var index = currentRow.find('.kodeproduk').attr('id').match(/\d+/)[0];

      // Jika kodeproduk dihapus, hapus juga value dari input nama produk dan harga berdasarkan index
      if ($(this).val() === '') {
        $('#namaproduk' + index).val('');
        $('#harga' + index).val('');
      } else {
            $.ajax({
            url: '/get-produk', // Ganti dengan URL endpoint Anda
            type: 'GET',
            data: { kodeproduk: kodeproduk },
            success: function(response) {
              // Isi input nama produk dan harga berdasarkan data yang diterima dari server
              $('#namaproduk' + index).val(response.namaproduk);
              $('#harga' + index).val(response.hargaproduk);
            },
            error: function(xhr, status, error) {
              // Tangani jika terjadi error saat melakukan request
              console.log('Error:', error);
            }
        });
      }
    });

    $(document).on('input', '#diskon', function () {
            var diskon = $(this).val();
            // var kuantitas = parseInt($(this).closest('tr').find('#kuantitas').val()) || 0;
            var harga = parseInt($(this).closest('tr').find('#harga').val()) || 0;
            var jumlahField = $(this).closest('tr').find('#jumlah');

            if (diskon !== '') {
                $.ajax({
                    url: '/get-jumlah', // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: { diskon: diskon, harga: harga },
                    success: function (response) {
                        jumlahField.val(response.jumlahharga);
                    }
                });
            } else {
                jumlahField.val(0);
            }
      });

      $(document).on('input', '.diskon', function () {
      var diskon = $(this).val();
      var currentRow = $(this).closest('tr');

      // var kuantitas = parseInt(currentRow.find('[id^="kuantitas"]').val()) || 0;
      var harga = parseInt(currentRow.find('[id^="harga"]').val()) || 0;
      var jumlahField = currentRow.find('[id^="jumlah"]');

      if (Number.isNaN(harga) || Number.isNaN(diskon)) {
        return; // Tidak melakukan perhitungan jika ada nilai yang tidak valid
      }

      var total = harga;
      var potonganDiskon = total * (diskon / 100);
      var jumlahSetelahDiskon = total - potonganDiskon;

      if ($(this).val() === '') {
        jumlahField.val(total);
      } else {
        jumlahField.val(jumlahSetelahDiskon);
      }
    });

    $(document).on('click','.btn-view',function(){
      $('#productModal').modal('show');
      // loadProducts(1);
    });

    $(document).on('click','#remove', function () {
              $(this).parents('tr').remove();
    })

    // $(document).on('click', '.pagination a', function(e) {
    //     e.preventDefault();
    //     var page = $(this).attr('href').split('page=')[1];
    //     loadProducts(page);
    // });

    // function loadProducts(page) {
    //     $.ajax({
    //         url: '/get-paginate?page=' + page,
    //         method: 'GET',
    //         success: function(response) {
    //           console.log(response)
    //             $('#tableProduct').html(response);
    //         }
    //     });
    // }
</script>
<script>
  $(document).ready(function() {
    $("#searchInput").on("input", function() {
      var value = $(this).val().toLowerCase();
      $("#tableProduct tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

  });
</script>