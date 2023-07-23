@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Barang Masuk')
@section('JudulTabel','Barang Masuk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Edit Data Barang Masuk</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/barangmasuk-dash/{{$barangmasuks->id}}" method="post">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control @error ('kodeproduk') is-invalid @enderror" id="kodeproduk" name="kodeproduk" value="{{$barangmasuks->kodeproduk}}">
                  </div>
                  @error('kodeproduk')
                  {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="namaproduk" value="{{$barangmasuks->namaproduk}}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kode Supplier</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="kodesupplier" value="{{$barangmasuks->kodesupplier}}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tanggalmasuk" value="{{$barangmasuks->tanggalmasuk}}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah Barang Masuk</label>
                    <input type="text" class="form-control" id="jmlhbarang" name="jumlahbarangmasuk" value="{{$barangmasuks->jumlahbarangmasuk}}">
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
        $('#nonota').on('keyup', function () {
            var nonota = $(this).val();
            if (nonota !== '') {
                $.ajax({
                    url: '/get-total', // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: { nonota: nonota },
                    success: function (response) {
                        $('#total').val(response.total);
                    }
                });
            }
        });
    });
</script>