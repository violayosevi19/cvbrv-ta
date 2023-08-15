@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Laba Rugi')
@section('JudulTabel','Laba Rugi')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
        <h4 class="mx-3 text-center">Edit Data Pengeluaran</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-12">
                <form action="/labarugi-dash/{{ $labarugi->id }}" method="post">
                  @csrf
                  @method('PUT')
                  <div class="row">
                    <div class="col">
                        <div class="mb-3">
                          <label for="mulai" class="form-label">Tanggal Mulai</label>
                          <input type="date" class="form-control @error ('tglmulai') is-invalid @enderror" id="tglmulai" name="tglmulai" value="{{ old('tglmulai',$labarugi->tglmulai)}}">
                        </div>
                        @error('tglmulai')
                        {{ $message }}
                        @enderror
                        <div class="mb-3">
                          <label for="mulai" class="form-label">Tanggal Akhir</label>
                          <input type="date" class="form-control @error ('tglakhir') is-invalid @enderror" id="tglakhir" name="tglakhir" value="{{ old('tglakhir',$labarugi->tglakhir)}}">
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Modal</label>
                          <input type="text" class="form-control" id="modal" name="modal" value="Rp{{ number_format(old('modal',$labarugi->modal), 0, ',', '.') }}">
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Gaji Karyawan</label>
                          <input type="text" class="form-control" id="gaji" name="gajikaryawan" value="Rp{{ number_format(old('gajikaryawan',$labarugi->gajikaryawan), 0, ',', '.') }}">
                        </div>
                    </div>
                    <div class="col">
                      <div class="mb-3">
                          <label for="mulai" class="form-label">Biaya Listrik</label>
                          <input type="text" class="form-control @error ('biayalistrik') is-invalid @enderror" id="biayalistrik" name="biayalistrik" value="Rp{{ number_format(old('biayalistrik',$labarugi->biayalistrik), 0, ',', '.') }}">
                        </div>
                        <div class="mb-3">
                          <label for="mulai" class="form-label">Biaya Operasional</label>
                          <input type="text" class="form-control @error ('biayaoperasional') is-invalid @enderror" id="biayaoperasional" name="biayaoperasional" value="Rp{{ number_format(old('biayaoperasional',$labarugi->biayaoperasional),0,',','.')}}">
                        </div>
                        @error('biayaoperasional')
                        {{ $message }}
                        @enderror
                        <div class="mb-3">
                          <label for="mulai" class="form-label">Biaya ATK</label>
                          <input type="text" class="form-control @error ('biayaATK') is-invalid @enderror" id="biayaATK" name="biayaATK" value="Rp{{ number_format(old('biayaATK',$labarugi->biayaATK), 0, ',', '.') }}" >
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Biaya Internet/Wifi</label>
                          <input type="text" class="form-control" id="biayainternet" name="biayainternet" value="Rp{{ number_format(old('biayainternet',$labarugi->biayainternet), 0, ',', '.') }}">
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