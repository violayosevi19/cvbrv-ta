@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Edit Detail Orderan')
@section('JudulTabel','Edit Detail Orderan')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4 class="mx-3 text-center">Edit Detail Orderan</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-3 mt-3">
              <form action="/detailorderan-dash/{{ $detailtokos[0]['nonota'] }}" method="post">
                @csrf
                @method('put')
              <div class="row">
                <div class="col col-md-4">
                  <table class="table">
                        <tr>
                            <th class=" align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Toko</th>
                            <td class="align-middle text-center">:</td>
                            <td class="align-middle text-center">
                                <input type="text" class="form-control namatoko" placeholder="Enter nama toko" name="namatoko" value="{{ $detailtokos[0]['namatoko'] }}">
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
                                <input type="text" class="form-control alamat" placeholder="Enter alamat" name="alamat" value="{{ $detailtokos[0]['alamat'] }}">
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
                                <input type="date" class="form-control" name="tglfaktur" value="{{ $detailtokos[0]['tglfaktur'] }}">
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
                                <input type="text" class="form-control" placeholder="Enter no faktur" name="nonota" value="{{ $detailtokos[0]['nonota'] }}" readonly>
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
                                <input type="date" class="form-control" placeholder="Enter jatuh tempo" name="jatuhtempo" value="{{ old('jatuhtempo',$detailtokos[0]['jatuhtempo']) }}">
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
                                <input type="text" class="form-control" placeholder="Enter sales" name="namasales" value="{{ $detailtokos[0]['namasales'] }}">
                            </td>
                        </tr>
                  </table>
                </div>
              </div>
              <div class="row">
                <div class="col">
                  <h4 class="mx-3 text-center mt-4">FAKTUR PENJUALAN</h4>
                </div>
              </div>
              <div class="col mt-3 justify-content-center produk-div">
                <div class="col col-md-4">
                  <button type="button" class="btn btn-warning btn-view" data-toggle="modal" data-target="#productModal">Pilih Produk</button>
                </div>
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
                            @foreach($detailtokos as $index => $details)
                            <tr>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control kodeproduk" id="kodeproduk{{$index}}" name="inputs[{{$index}}][kodeproduk]" placeholder="Enter kode produk" value="{{ $details['kodeproduk'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control namaproduk" id="namaproduk{{$index}}"  name="inputs[{{$index}}][namaproduk]" placeholder="Enter nama produk" value="{{ $details['namaproduk'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control @error('inputs.*.kuantitas') is-invalid  @enderror kuantitas" id="kuantitas{{$index}}"  name="inputs[{{$index}}][kuantitas]" placeholder="Enter kuantitas" value="{{ $details['kuantitas'] }}">
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
                                <input type="text" class="form-control harga" id="harga{{$index}}" name="inputs[{{$index}}][harga]" placeholder="Enter harga produk" value="{{ $details['harga'] }}">
                              </td>
                              <td class="align-middle text-center">
                                <div class="input-group">
                                  <input type="text" class="form-control diskon" id="diskon{{$index}}"  name="inputs[{{$index}}][diskon]" placeholder="Enter diskon" value="{{ $details['diskon'] }}">
                                  <span class="input-group-text" id="basic-addon1">%</span>
                                </div>
                              </td>
                              <td class="align-middle text-center">
                                <input type="text" class="form-control jumlah" id="jumlah{{$index}}" name="inputs[{{$index}}][jumlah]" placeholder="Enter jumlah" value="Rp{{ number_format($details['jumlah'],0,',','.') }}">
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
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Produk</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi</th>
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
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Rp{{ number_format(($item->harga),0,',','.')}}</span>
                </td>
                @if($item->jenisproduk !== null)
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">{{ $item->jenisproduk->jenis}}</span>
                </td>
                @else
                <td class="align-middle text-center">
                  <span class="text-secondary text-xs font-weight-bold">Jenis Kosong</span>
                </td>
                @endif
                <td class="align-middle text-center">
                  <a href="#" class="btn btn-success text-secondary font-weight-bold text-xs text-white select-product"
                    data-kodeproduk="{{ $item->kodeproduk }}"
                    data-namaproduk="{{ $item->namaproduk }}"
                    data-harga="{{ $item->harga }}"
                    data-diskon=""
                    data-jenisproduk="{{ $item->jenisproduk ? $item->jenisproduk->jenis : ''}}">
                    Pilih
                  </a>
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
        console.log(totalData)
        let counter = totalData;
        // console.log(counter);
        $('#add').on('click',function() {
            // Menambahkan baris input baru ke dalam tabel
            function addNewRow(){
                const newRow = `
                <tr>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control kodeproduk" id="kodeproduk"  name="inputs[`+counter+`][kodeproduk]" placeholder="Enter kode produk">
                    </td>
                    <td class="align-middle text-center">
                    <input type="text" class="form-control namaproduk" id="namaproduk" name="inputs[`+counter+`][namaproduk]" placeholder="Enter nama produk">
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
                    <input type="text" class="form-control harga" id="harga" name="inputs[`+counter+`][harga]" placeholder="Enter harga">
                    </td>
                    <td class="align-middle text-center">
                    <div class="input-group">
                        <input type="text" class="form-control" id="diskon" name="inputs[`+counter+`][diskon]" placeholder="Enter diskon">
                        <span class="input-group-text" id="basic-addon1">%</span>
                    </div>
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

          // modal
          $('.select-product').on('click', function() {
            const kodeproduk = $(this).data('kodeproduk');
            const namaproduk = $(this).data('namaproduk');
            const harga = $(this).data('harga');
            const jenisproduk = $(this).data('jenisproduk');
          
                
            const newRow = `
              <tr class="new">
                <td class="align-middle text-center">
                  <input type="text" class="form-control kodeproduk" id="kodeproduk" name="inputs[`+counter+`][kodeproduk]" value="${kodeproduk}">
                </td>
                <td class="align-middle text-center">
                  <input type="text" class="form-control namaproduk" id="namaproduk" name="inputs[`+counter+`][namaproduk]" value="${namaproduk}">
                </td>
                <td class="align-middle text-center">
                  <input type="text"  class="form-control @error('inputs.*.kuantitas') is-invalid  @enderror" id="kuantitas" name="inputs[`+counter+`][kuantitas]" placeholder="Enter kuantitas">
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
                  <input type="text" class="form-control harga" id="harga"  name="inputs[`+counter+`][harga]" placeholder="Enter harga" value="${harga}">
                </td>
                <td class="align-middle text-center">
                    <div class="input-group">
                       <input type="number" class="form-control" id="diskon" name="inputs[`+counter+`][diskon]" placeholder="Enter disc">
                        <span class="input-group-text" id="basic-addon1">%</span>
                    </div>
                </td>
                <td class="align-middle text-center">
                  <input type="text" class="form-control" id="jumlah"  name="inputs[`+counter+`][jumlah]" placeholder="Enter jumlah">
                </td>
                <td class="align-middle text-center">
                  <button class="btn btn-danger mt-3" type="button" name="remove" id="remove">Remove</button>
                </td>
                </tr>
            `;
            
            // Append the new row to the table
            $('form .produk-div .table tbody').append(newRow);
            counter++;
            // Increment the counter
           

            // Close the product modal
            $('#productModal').modal('hide');
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
    function formatRupiah(angka) {
        var number_string = angka.toString();
        var split = number_string.split(',');
        var sisa = split[0].length % 3;
        var rupiah = split[0].substr(0, sisa);
        var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
        }


    $(document).on('input', '.diskon', function () {
      var diskon = parseInt($(this).val());
      var currentRow = $(this).closest('tr');

      var kuantitas = parseInt(currentRow.find('[id^="kuantitas"]').val()) || 0;
      // var harga = parseInt($(this).closest('tr').find('[id^="harga"]').val()) || 0;
      var harga = parseInt(currentRow.find('[id^="harga"]').val()) || 0;
      var jumlahField = currentRow.find('[id^="jumlah"]');
      console.log(kuantitas, harga);


      if (Number.isNaN(kuantitas) || Number.isNaN(harga) || Number.isNaN(diskon)) {
        return; // Tidak melakukan perhitungan jika ada nilai yang tidak valid
      }

      var total = kuantitas * harga;
      var potonganDiskon = total * (diskon / 100);
      var jumlahSetelahDiskon = total - potonganDiskon;

      if ($(this).val() === '') {
        var formattedJumlah = formatRupiah(total);
        jumlahField.val(formattedJumlah);
      } else {
        var formattedJumlah = formatRupiah(jumlahSetelahDiskon);
        jumlahField.val(formattedJumlah);
      }
    });

    $(document).on('input', '#diskon', function () {
            var diskon = parseInt($(this).val());
            var kuantitas = parseInt($(this).closest('tr').find('#kuantitas').val()) || 0;
            var harga = parseInt($(this).closest('tr').find('#harga').val()) || 0;
            var jumlahField = $(this).closest('tr').find('#jumlah');
            console.log(harga, kuantitas,diskon);

            if (diskon !== '') {
                $.ajax({
                    url: '/get-jumlahdetail', // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: { diskon: diskon, kuantitas: kuantitas, harga: harga },
                    success: function (response) {
                      var formattedJumlah = formatRupiah(response.jumlahharga);
                      jumlahField.val(formattedJumlah);
                    }
                });
            } else {
                jumlahField.val(0);
            }
    });


    $(document).on('click','.btn-view',function(){
      $('#productModal').modal('show');
    });

    $(document).on('click','#remove', function () {
              $(this).parents('tr').remove();
    })

  
    // $(document).on('click', '.select-product', function() {
    //         const kodeproduk = $(this).data('kodeproduk');
    //         const namaproduk = $(this).data('namaproduk');
    //         const harga = $(this).data('harga');
    //         const jenisproduk = $(this).data('jenisproduk');
    //         const totalData = {!! $totaldatapernota !!};
    //         console.log(totalData)
    //         let counter = totalData;
                
    //         const newRow = `
    //           <tr class="new">
    //             <td class="align-middle text-center">
    //               <input type="text" class="form-control kodeproduk" id="kodeproduk" name="inputs[`+counter+`][kodeproduk]" value="${kodeproduk}">
    //             </td>
    //             <td class="align-middle text-center">
    //               <input type="text" class="form-control namaproduk" id="namaproduk" name="inputs[`+counter+`][namaproduk]" value="${namaproduk}">
    //             </td>
    //             <td class="align-middle text-center">
    //               <input type="number" class="form-control" id="kuantitas" name="inputs[`+counter+`][kuantitas]" placeholder="Enter kuantitas">
    //             </td>
    //             <td class="align-middle text-center">
    //               <input type="text" class="form-control" id="satuan"  name="inputs[`+counter+`][satuan]" placeholder="Enter satuan">
    //             </td>
    //             <td class="align-middle text-center">
    //               <input type="number" class="form-control harga" id="harga"  name="inputs[`+counter+`][harga]" placeholder="Enter harga" value="${harga}">
    //             </td>
    //             <td class="align-middle text-center">
    //                 <div class="input-group">
    //                    <input type="number" class="form-control" id="diskon" name="inputs[`+counter+`][diskon]" placeholder="Enter disc">
    //                     <span class="input-group-text" id="basic-addon1">%</span>
    //                 </div>
    //             </td>
    //             <td class="align-middle text-center">
    //               <input type="number" class="form-control" id="jumlah"  name="inputs[`+counter+`][jumlah]" placeholder="Enter jumlah">
    //             </td>
    //             <td class="align-middle text-center">
    //               <button class="btn btn-danger mt-3" type="button" name="remove" id="remove">Remove</button>
    //             </td>
    //             </tr>
    //         `;
            
    //         // Append the new row to the table
    //         $('form .produk-div .table tbody').append(newRow);

    //         // Increment the counter
    //         counter++;

    //         // Close the product modal
    //         $('#productModal').modal('hide');
    //       });
    
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