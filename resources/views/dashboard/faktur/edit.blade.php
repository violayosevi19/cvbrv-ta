@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Faktur')
@section('JudulTabel','Faktur')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Edit Faktur</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/faktur-dash/{{ $fakturs->id }}" method="post">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">No Nota</label>
                    <input type="text" class="form-control @error ('nonota') is-invalid @enderror" id="nonota" name="nonota" value="{{ old('nonota',$fakturs->nonota) }}">
                  </div>
                  @error('nonota')
                  {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="namatoko" name="namatoko"  value="{{ old('namatoko',$fakturs->namatoko) }}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Faktur</label>
                    <input type="date" class="form-control" id="tglfaktur" name="tglfaktur"  value="{{ old('tglfaktur',$fakturs->tglfaktur) }}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jatuh Tempo</label>
                    <input type="date" class="form-control" id="jatuhtempo" name="jatuhtempo" value="{{ old('jatuhtempo',$fakturs->jatuhtempo) }}">
                  </div>
                  
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                    <select class="form-select" id="keterangan" name="keterangan">
                      <option value="cash">Cash</option>
                      <option value="kredit">Kredit</option>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Total</label>
                    <input type="text" class="form-control" id="total" name="total"  value="{{ old('total',$fakturs->total) }}">
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