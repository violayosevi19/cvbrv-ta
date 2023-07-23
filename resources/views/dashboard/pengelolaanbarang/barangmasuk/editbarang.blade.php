@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Barang Masuk')
@section('JudulTabel','Barang Masuk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3 text-center">Edit Barang Masuk</h6>
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
                    <table class="table">
                        <thead>
                            <tr>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kode Produk</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Kuantitas</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Satuan</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diskon</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailproduks as $details)
                            <tr>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control" id="kodeproduk"  name="inputs[0][kodeproduk]" placeholder="Enter kode produk" value="{{ $details['kodeproduk'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control" id="namaproduk"  name="inputs[0][namaproduk]" placeholder="Enter nama produk" value="{{ $details['namaproduk'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="number" class="form-control" id="kuantitas" name="inputs[0][stock]" placeholder="Enter kuantitas" value="{{ $details['stock'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control" id="harga"  name="inputs[0][harga]" placeholder="Enter harga produk" value="{{ $details['harga'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control" id="diskon" name="inputs[0][diskon]" placeholder="Enter diskon" value="{{ $details['diskon'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="number" class="form-control" id="jumlah"  name="inputs[0][jumlah]" placeholder="Enter jumlah" value="{{ $details['jumlah'] }}">
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
                    <input type="text" class="form-control" id="kuantitas" name="inputs[`+counter+`][stock]" placeholder="Enter kuantitas">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="harga" name="inputs[`+counter+`][harga]" placeholder="Enter harga">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="diskon" name="inputs[`+counter+`][diskon]" placeholder="Enter diskon">
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

    $(document).on('keyup', '#diskon', function () {
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