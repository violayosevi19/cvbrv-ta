@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Penjualan')
@section('JudulTabel','Penjualan')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Edit Penjualan</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/penjualan-dash/{{ $penjualans->id }}" method="post">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">No Nota</label>
                    <input type="text" class="form-control @error ('nonota') is-invalid @enderror" id="nonota" name="nonota" value="{{ old('nonota',$penjualans->nonota) }}">
                  </div>
                  @error('nonota')
                  {{ $message }}
                  @enderror
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="namatoko" name="namatoko"  value="{{ old('namatoko',$penjualans->namatoko) }}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Total Penjualan</label>
                    <input type="text" class="form-control" id="total" name="totalpenjualan"  value="{{ old('totalpenjualan',$penjualans->totalpenjualan) }}">
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
    $(document).ready(function(){
      $('#nonota').on('keyup',function() {
                var nonota = $(this).val();
                console.log(nonota);
                if(nonota !== '') {
                  $.ajax({
                    url:'/get-faktur',
                    type: 'GET',
                    data : { nonota : nonota },
                    success : function (response) {
                      $('#namatoko').val(response.namatoko)
                      $('#total').val(response.total)
                    },
                    error: function(xhr, status, error) {
                        // Handle the error response
                        console.log('Error:', error);
                    }
                  })
                } else {
                  $('#namatoko').val('')
                  $('#total').val('')
                }
      });      
    
    });
</script>