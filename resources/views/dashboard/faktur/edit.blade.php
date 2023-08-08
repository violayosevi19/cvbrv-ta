@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Faktur')
@section('JudulTabel','Faktur')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h3 class="mx-3 text-center">Edit Faktur</h3>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-12">
                <form action="/faktur-dash/{{ $fakturs->id }}" method="post">
                  @csrf
                  @method('put')
                  <div class="row">
                    <div class="col col-md-6">
                        <div class="mb-3">
                          <label for="kodeproduk" class="form-label">No Nota</label>
                          <input type="text" class="form-control @error ('nonota') is-invalid @enderror" id="nonota" name="nonota" value="{{ old('nonota',$fakturs->nonota) }}" readonly>
                        </div>
                        @error('nonota')
                        {{ $message }}
                        @enderror
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                          <input type="text" class="form-control" id="namatoko" name="namatoko"  value="{{ old('namatoko',$fakturs->namatoko) }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Tanggal Faktur</label>
                          <input type="date" class="form-control" id="tglfaktur" name="tglfaktur"  value="{{ old('tglfaktur',$fakturs->tglfaktur) }}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Jatuh Tempo</label>
                          <input type="date" class="form-control" id="jatuhtempo" name="jatuhtempo" value="{{ old('jatuhtempo',$fakturs->jatuhtempo) }}" readonly>
                        </div>
                       
                    </div>
                    <div class="col col-md-6">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Sopir</label>
                          <input type="text" class="form-control" id="sopir" name="sopir" value="{{ old('sopir',$fakturs->sopir) }}">
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                          <select class="form-select" id="keterangan" name="keterangan">
                            <option value="Dalam Pesanan" @if(old('keterangan',$fakturs->keterangan) === "Dalam Pesanan") selected @endif>Dalam Pesanan</option>
                            <option value="Sedang Diantar" @if(old('keterangan',$fakturs->keterangan) === "Sedang Diantar") selected @endif>Sedang Diantar</option>
                            <option value="Sudah Diantar" @if(old('keterangan',$fakturs->keterangan) === "Sudah Diantar") selected @endif>Sudah Diantar</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Pembayaran</label>
                          <select class="form-select" id="pembayaran" name="pembayaran">
                            <option value="Cash" @if(old('pembayaran',$fakturs->pembayaran) === "Cash") selected @endif>Cash</option>
                            <option value="Kredit" @if(old('pembayaran',$fakturs->pembayaran) === "Kredit") selected @endif>Kredit</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Total</label>
                          <input type="text" class="form-control" id="total" name="total"  value="{{ old('total',$fakturs->total) }}" readonly>
                        </div>
                    </div>
                  </div>
                  <div class="d-flex justify-content-center mb-3">
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