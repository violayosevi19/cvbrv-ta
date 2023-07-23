@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Edit Detail Orderan')
@section('JudulTabel','Edit Detail Orderan')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3 text-center">Edit Detail Orderan</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-3 mt-3">
                @foreach($detailtokos as $detail)
              <form action="/detailorderan-dash/{{ $detail['nonota'] }}" method="post">
                @csrf
                @method('put')
              <div class="row">
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Toko</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control namatoko" placeholder="Enter nama toko" name="namatoko" value="{{ $detail['namatoko'] }}">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class="align-middle  text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control alamat" placeholder="Enter alamat" name="alamat" value="{{ $detail['alamat'] }}">
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
                                <input type="date" class="form-control" name="tglfaktur" value="{{ $detail['tglfaktur'] }}">
                            </td>
                        </tr>
                    </table>
                </div>
              </div>
              <div class="row">
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Nota</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control" placeholder="Enter no faktur" name="nonota" value="{{ $detail['nonota'] }}">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jatuh Tempo</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control" placeholder="Enter jatuh tempo" name="jatuhtempo" value="{{ $detail['jatuhtempo'] }}">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Sales</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control" placeholder="Enter sales" name="namasales" value="{{ $detail['namasales'] }}">
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
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Satuan</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga Satuan</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Diskon</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailproduks as $index => $details)
                            <tr>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control" id="kodeproduk{{$index}}" name="inputs[{{$index}}][kodeproduk]" placeholder="Enter kode produk" value="{{ $details['kodeproduk'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control" id="namaproduk{{$index}}"  name="inputs[{{$index}}][namaproduk]" placeholder="Enter nama produk" value="{{ $details['namaproduk'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="number" class="form-control @error('inputs.*.kuantitas') is-invalid  @enderror" id="kuantitas{{$index}}"  name="inputs[{{$index}}][kuantitas]" placeholder="Enter kuantitas" value="{{ $details['kuantitas'] }}">
                                @error('inputs.*.kuantitas')
                                  <span class="invalid-feedback">
                                      {{ $message }}
                                  </span>
                                @enderror
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control satuan" id="satuan{{$index}}"  name="inputs[{{$index}}][satuan]" placeholder="Enter satuan" value="{{ $details['satuan'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control" id="harga{{$index}}" name="inputs[{{$index}}][harga]" placeholder="Enter harga produk" value="{{ $details['harga'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control" id="diskon{{$index}}"  name="inputs[{{$index}}][diskon]" placeholder="Enter diskon" value="{{ $details['diskon'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="number" class="form-control" id="jumlah{{$index}}" name="inputs[{{$index}}][jumlah]" placeholder="Enter jumlah" value="{{ $details['jumlah'] }}">
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
        // console.log(counter);
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
                    <input type="text" class="form-control @error('inputs.*.kuantitas') is-invalid  @enderror" id="kuantitas"  name="inputs[`+counter+`][kuantitas]" placeholder="Enter kuantitas">
                    @error('inputs.*.kuantitas')
                      <span class="invalid-feedback">
                          {{ $message }}
                      </span>
                    @enderror
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="satuan"  name="inputs[`+counter+`][satuan]" placeholder="Enter satuan">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="harga" name="inputs[`+counter+`][harga]" placeholder="Enter harga">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="diskon" name="inputs[`+counter+`][diskon]" placeholder="Enter diskon">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control" id="jumlah"  name="inputs[`+counter+`][jumlah]" placeholder="Enter jumlah">
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

          $('.namatoko').on('input',function() {
              var namatoko = $(this).val();
              if(namatoko !== '') {
                $.ajax({
                  url:'/get-alamat',
                  type: 'GET',
                  data : { namatoko : namatoko },
                  success : function (response) {
                    $('.alamat').val(response.alamat)
                  }
                })
              } else {
                $('.alamat').val('');
              }
          });

    });

    
    $(document).on('keyup','#kodeproduk', function() {
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

    $(document).on('keyup', '#diskon', function () {
            var diskon = $(this).val();
            var kuantitas = parseInt($(this).closest('tr').find('#kuantitas').val()) || 0;
            var harga = parseInt($(this).closest('tr').find('#harga').val()) || 0;
            var jumlahField = $(this).closest('tr').find('#jumlah');

            if (diskon !== '') {
                $.ajax({
                    url: '/get-jumlahdetail', // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: { diskon: diskon, kuantitas: kuantitas, harga: harga },
                    success: function (response) {
                        jumlahField.val(response.jumlahharga);
                    }
                });
            } else {
                jumlahField.val(0);
            }
    });
    
</script>