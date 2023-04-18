@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Pembayaran')
@section('JudulTabel','Pembayaran')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Edit Pembayaran</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/pembayaran-dash/{{ $pembayarans->id }}" method="post">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">No Nota</label>
                    <input type="text" class="form-control @error ('nonota') is-invalid @enderror" id="exampleFormControlInput1" name="nonota" value="{{ old('nonota',$pembayarans->nonota) }}">
                  </div>
                  @error('nonota')
                  {{ $message }}
                  @enderror
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="namatoko" value="{{ old('namatoko',$pembayarans->namatoko) }}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Total Pembayaran</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="totalpembayaran"  value="{{ old('totalpembayaran',$pembayarans->totalpembayaran) }}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Keterangan</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keterangan"> {{ old('keterangan',$pembayarans->keterangan) }}</textarea>
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Bayar</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tglbayar"  value="{{ old('tglbayar',$pembayarans->tglbayar) }}">
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