@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Barang Masuk')
@section('JudulTabel','Barang Masuk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4 class="mx-3 text-center">Detail Barang Masuk</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-3 mt-3">
                @foreach($detailtokos as $detail)
              <form action="/barangmasuk-dash/{{ $detail['nonota'] }}" method="post">
              <div class="row">
              <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Supplier</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-m font-weight-bold" name="nonota">{{ $detail['namasupplier'] }}</span>
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
                                <span class="text-secondary text-m font-weight-bold">{{ $detail['tanggalmasuk'] }}</span>
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
                            <span class="text-secondary text-m font-weight-bold">{{ $detail['nonota'] }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
              </div>
              @endforeach
              <div class="row">
                <div class="col">
                  <h4 class="mx-3 text-center mt-4">FAKTUR BARANG MASUK</h4>
                </div>
              </div>
              <div class="col mt-3 justify-content-center produk-div">
                    <table class="table">
                        <thead>
                            <tr>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Produk</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kuantitas</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Satuan</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Satuan</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diskon</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailproduks as $index => $details)
                            <tr>
                            <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['kodeproduk'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['namaproduk'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['stock'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">pcs</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['harga'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['diskon'] }}%</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['jumlah'] }}</span>
                              </td>
                              @endforeach
                            </tr>
                            <tr>
                                <td colspan="6" class="align-middle text-center">
                                  <span class="text-center text-uppercase text-danger fs-3 font-weight-bolder opacity-7">Total</span>
                                </td>
                                <td class="align-middle text-center">
                                  <span class="text-center text-uppercase text-danger fs-3 font-weight-bolder opacity-7">{{ $bayar }}</span>
                                </td>
                            </tr>
                        </tbody>
                      </table>
                 </div>
              </form>
            </div>
          </div>
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
                    <input type="number" class="form-control" id="harga" name="inputs[`+counter+`][harga]" placeholder="Enter harga">
                    </td>
                    <td class="align-middle text-center">
                    <input type="number" class="form-control" id="diskon" name="inputs[`+counter+`][diskon]" placeholder="Enter diskon">
                    </td>
                    <td class="align-middle text-center">
                    <input type="number" class="form-control" id="jumlah" name="inputs[`+counter+`][jumlah]" placeholder="Enter jumlah">
                    </td>
                    <td class="align-middle text-center">
                    <button class="btn btn-danger mt-3" type="button" name="remove" id="remove">Remove</button>
                    </td>
                </tr>
                `;
                $('form .produk-div .table tbody').append(newRow);
            }
            addNewRow();

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
            var kuantitas = parseInt($(this).closest('tr').find('#kuantitas').val()) || 0;
            var harga = parseInt($(this).closest('tr').find('#harga').val()) || 0;
            var jumlahField = $(this).closest('tr').find('#jumlah');

            if (diskon !== '') {
                $.ajax({
                    url: '/get-jumlah', // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: { diskon: diskon, stock: kuantitas, harga: harga },
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

      var kuantitas = parseInt(currentRow.find('[id^="kuantitas"]').val()) || 0;
      var harga = parseInt(currentRow.find('[id^="harga"]').val()) || 0;
      var jumlahField = currentRow.find('[id^="jumlah"]');

      if (Number.isNaN(kuantitas) || Number.isNaN(harga) || Number.isNaN(diskon)) {
        return; // Tidak melakukan perhitungan jika ada nilai yang tidak valid
      }

      var total = kuantitas * harga;
      var potonganDiskon = total * (diskon / 100);
      var jumlahSetelahDiskon = total - potonganDiskon;

      if ($(this).val() === '') {
        jumlahField.val(total);
      } else {
        jumlahField.val(jumlahSetelahDiskon);
      }
    });
</script>