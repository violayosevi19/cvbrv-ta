@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Stock')
@section('JudulTabel','Stock')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
        <h4 class="mx-3 text-center">Tambah Data Stok</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/stock-dash" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control @error ('kodeproduk') is-invalid @enderror" id="kodeproduk" name="kodeproduk">
                  </div>
                  @error('kodeproduk')
                  {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="namaproduk" name="namaproduk">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah Stock Tersedia</label>
                    <input type="text" class="form-control" id="stock" name="stock">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan">
                  </div>
                  <div class="mb-3">
                    <button type="submit" class="btn btn-warning">Submit</button>
                  </div>
                </form>
              </div>
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
          $('#kodeproduk').on('keyup',function() {
              var kodeproduk = $(this).val();
              if(kodeproduk !== '') {
                $.ajax({
                  url:'/get-produk',
                  type: 'GET',
                  data : { kodeproduk : kodeproduk },
                  success : function (response) {
                    $('#namaproduk').val(response.namaproduk);
                    $('#hargaproduk').val(response.hargaproduk);
                  },
                  error: function(xhr, status, error) {
                      // Handle the error response
                      console.log('Error:', error);
                  }
                })
              } else {
                $('#namaproduk').val('');
                $('#hargaproduk').val('');
              }
          });

    });
</script>
