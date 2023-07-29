@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Faktur')
@section('JudulTabel','Faktur')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Create Faktur</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/faktur-dash" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">No Nota</label>
                    <input type="text" class="form-control @error ('nonota') is-invalid @enderror" id="nonota" name="nonota">
                  </div>
                  @error('nonota')
                  {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="namatoko" name="namatoko">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Faktur</label>
                    <input type="date" class="form-control" id="tglfaktur" name="tglfaktur">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jatuh Tempo</label>
                    <input type="date" class="form-control" id="jatuhtempo" name="jatuhtempo">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                    <select class="form-select" id="keterangan" name="keterangan">
                      <option value="Dalam Pesanan">Dalam Pesanan</option>
                      <option value="Sedang Diantar">Sedang Diantar</option>
                      <option value="Sudah Diantar">Sudah Diantar</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Pembayaran</label>
                    <select class="form-select" id="pembayaran" name="pembayaran">
                      <option value="Cash">Cash</option>
                      <option value="Kredit">Kredit</option>
                    </select>
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Total</label>
                    <input type="text" class="form-control" id="total" name="total">
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
        $('#nonota').on('input', function () {
            var nonota = $(this).val();
            if (nonota !== '') {
                $.ajax({
                    url: '/get-data', // Ganti dengan URL yang sesuai
                    type: 'GET',
                    data: { nonota: nonota },
                    success: function (response) {
                        $('#total').val(response.total);
                        $('#namatoko').val(response.namatoko);
                        $('#tglfaktur').val(response.tglfaktur);
                        $('#jatuhtempo').val(response.jatuhtempo);
                    }
                });
            } else {
              $('#total').val('');
              $('#namatoko').val('');
              $('#tglfaktur').val('');
              $('#jatuhtempo').val('');
            }
        });
    });
</script>