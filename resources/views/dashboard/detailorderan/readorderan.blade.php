@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Read Detail Orderan')
@section('JudulTabel','Read Detail Orderan')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4 class="mx-3 text-center mt-4">FAKTUR PENJUALAN</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-3 mt-3">
                @foreach($detailtokos as $detail)
              <form action="/detailorderan-dash/{{ $detail['nonota'] }}" method="post">
              <div class="row">
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class="align-middle text-start text-capitalize text-secondary text-m font-weight-bolder">Nama Toko</th>
                            <td class="align-middle texxt-start">:</td>
                            <td class="align-middle text-start">
                                <span class="text-secondary text-m font-weight-bold">{{$detail['namatoko']}}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class="align-middle text-start text-capitalize text-secondary text-m font-weight-bolder">Alamat</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-m font-weight-bold">{{$detail['alamat']}}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class="align-middle text-start text-capitalize text-secondary text-m font-weight-bolder">Tanggal Faktur</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-m font-weight-bold" name="tglfaktur">{{ $detail['tglfaktur'] }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
              </div>
              <div class="row">
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class="align-middle text-start text-capitalize text-secondary text-m font-weight-bolder">No Nota</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-m font-weight-bold" name="nonota">{{ $detail['nonota'] }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class="align-middle text-start text-capitalize text-secondary text-m font-weight-bolder">Jatuh Tempo</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-m font-weight-bold"  name="jatuhtempo">{{ $detail['jatuhtempo'] }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class="align-middle text-start text-capitalize text-secondary text-m font-weight-bolder">Nama Sales</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <span class="text-secondary text-m font-weight-bold" name="namasales">{{ $detail['namasales'] }}</span>
                            </td>
                        </tr>
                  </table>
                </div>
              </div>
              @endforeach
              <div class="col mt-3 justify-content-center produk-div">
                    <table class="table">
                        <thead>
                            <tr>
                              <th class="text-center text-capitalize text-secondary text-m font-weight-bolder opacity-7">Kode Produk</th>
                              <th class="text-center text-capitalize text-secondary text-m font-weight-bolder opacity-7">Nama Produk</th>
                              <th class="text-center text-capitalize text-secondary text-m font-weight-bolder opacity-7">Kuantitas</th>
                              <th class="text-center text-capitalize text-secondary text-m font-weight-bolder opacity-7">Satuan</th>
                              <th class="text-center text-capitalize text-secondary text-m font-weight-bolder opacity-7">Harga Satuan</th>
                              <th class="text-center text-capitalize text-secondary text-m font-weight-bolder opacity-7">Diskon</th>
                              <th class="text-center text-capitalize text-secondary text-m font-weight-bolder opacity-7">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detailproduks as $details)
                            <tr>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['kodeproduk'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['namaproduk'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['kuantitas'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['satuan'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['harga'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['diskon'] }}</span>
                              </td>
                              <td class="align-middle text-center">
                                <span class="text-xs">{{ $details['jumlah'] }}</span>
                              </td>
                              @endforeach
                            </tr>
                            <tr>
                                <td colspan="6" style="border:1px solid;" class="align-middle text-center">
                                  <span class="text-center text-uppercase text-danger fs-3 font-weight-bolder opacity-7">Total</span>
                                </td>
                                <td style="border:1px solid;" class="align-middle text-center">
                                  <span class="text-center text-uppercase text-danger fs-3 font-weight-bolder opacity-7">{{ $bayar }}</span>
                                </td>
                            </tr>
                        </tbody>
                      </table>
                 </div>
              </form>
            </div>
            <!-- <div class="row px-3 py-3">
              <div class="col col-md-3">
                <button class="btn btn-primary mt-3" type="button" name="submit" id="submit">Cetak Faktur</button>
              </div>
            </div> -->
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
                    <input type="text" class="form-control"  name="inputs[`+counter+`][kodeproduk]" placeholder="Enter kode produk">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control"  name="inputs[`+counter+`][namaproduk]" placeholder="Enter nama produk">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control"  name="inputs[`+counter+`][kuantitas]" placeholder="Enter kuantitas">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control"  name="inputs[`+counter+`][satuan]" placeholder="Enter satuan">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control"  name="inputs[`+counter+`][harga]" placeholder="Enter harga">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control"  name="inputs[`+counter+`][diskon]" placeholder="Enter diskon">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control"  name="inputs[`+counter+`][jumlah]" placeholder="Enter jumlah">
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
</script>