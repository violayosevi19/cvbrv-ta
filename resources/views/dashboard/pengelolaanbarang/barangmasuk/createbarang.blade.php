@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Barang Masuk')
@section('JudulTabel','Barang Masuk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4 class="mx-3 text-center">Masukkan Data Barang Masuk</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <form action="/barangmasuk-dash" method="post">
                @csrf
              <div class="row">
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Supplier</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control" placeholder="Enter nama supplier" name="namasupplier">
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
                                <input type="date" class="form-control" placeholder="Enter tanggal faktur" name="tanggalmasuk">
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
                                <input type="text" class="form-control" placeholder="Enter nofaktur" name="nonota">
                            </td>
                        </tr>
                    </table>
                </div>
              </div>
              <div class="col mt-3 justify-content-center produk-div">
                    <table class="table">
                        <thead>
                            <tr>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Produk</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kuantitas</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Satuan</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diskon</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control"  name="inputs[0][kodeproduk]" id="kodeproduk" placeholder="Enter kode produk">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control"  name="inputs[0][namaproduk]" id="namaproduk" placeholder="Enter nama produk">
                              </td>
                              <td class="align-middle text-center">
                                <input type="number" class="form-control"  name="inputs[0][stock]" id="kuantitas" placeholder="Enter kuantitas">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control"  name="inputs[0][harga]" id="harga" placeholder="Enter harga produk">
                              </td>
                              <td class="align-middle text-center">
                               <div class="input-group">
                                  <input type="number" class="form-control diskon" id="diskon"  name="inputs[0][diskon]" placeholder="Enter disc">
                                  <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                              </td>
                              <td class="align-middle text-center">
                                <input type="number" class="form-control"  name="inputs[0][jumlah]" id="jumlah" placeholder="Enter jumlah">
                              </td>
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
  @endsection
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
        let counter = 0;
        $('#add').on('click',function() {
          counter++;
            // var multiInput = document.getElementById('multi-input');
            // var multiInputDatas = [];
            // const kodeProduk = $('input[name="kodeproduk"]').val();
            // const namaProduk = $('input[name="namaproduk"]').val();
            // const kuantitas = $('input[name="stock"]').val();
            // const hargaSatuan = $('input[name="harga"]').val();
            // const diskon = $('input[name="diskon"]').val();
            // const jumlah = $('input[name="jumlah"]').val();

            // Menambahkan baris input baru ke dalam tabel
            const newRow = `
              <tr>
                <td class="align-middle text-center">
                  <input type="text" class="form-control kodeproduk" id="kodeproduk"  name="inputs[`+counter+`][kodeproduk]" placeholder="Enter kode produk">
                </td>
                <td class="align-middle text-center">
                  <input type="text" class="form-control namaproduk" id="namaproduk"  name="inputs[`+counter+`][namaproduk]" placeholder="Enter nama produk">
                </td>
                <td class="align-middle text-center">
                  <input type="number" class="form-control kuantitas " id="kuantitas" name="inputs[`+counter+`][stock]" placeholder="Enter kuantitas">
                </td>
                <td class="align-middle text-center">
                  <input type="number" class="form-control harga" id="harga"  name="inputs[`+counter+`][harga]" placeholder="Enter harga">
                </td>
                <td class="align-middle text-center">
                  <div class="input-group">
                       <input type="number" class="form-control" id="diskon" name="inputs[`+counter+`][diskon]" placeholder="Enter disc">
                        <span class="input-group-text" id="basic-addon1">%</span>
                    </div>
                </td>
                <td class="align-middle text-center">
                  <input type="number" class="form-control jumlah" id="jumlah" name="inputs[`+counter+`][jumlah]" placeholder="Enter jumlah">
                </td>
                <td class="align-middle text-center">
                  <button class="btn btn-danger mt-3" type="button" name="remove" id="remove">Remove</button>
                </td>
              </tr>
            `;
            $('form .produk-div .table tbody').append(newRow);

            $(document).on('click','#remove', function () {
              $(this).parents('tr').remove();
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
              if(kodeproduk !== '') {
                $.ajax({
                  url:'/get-produk',
                  type: 'GET',
                  data : { kodeproduk : kodeproduk },
                  success : function (response) {
                    namaprodukField.val(response.namaproduk)
                  },
                  error: function(xhr, status, error) {
                      // Handle the error response
                      console.log('Error:', error);
                  }
                })
              } else {
                $('#namaproduk').val('');
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
    
</script>