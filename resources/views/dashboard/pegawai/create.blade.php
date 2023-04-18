@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Pegawai')
@section('JudulTabel','Pegawai')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Create Employees Datas</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/pegawai-dash" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Id Pegawai</label>
                    <input type="text" class="form-control @error ('idpegawai') is-invalid @enderror" id="exampleFormControlInput1" name="idpegawai">
                  </div>
                  @error('idpegawai')
                    {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Pegawai</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="nama">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tgllahir">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="jekel" id="jk" value="L" checked>
                      <label class="form-check-label" for="inlineCheckbox1">Laki-Laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="jekel" id="jk" value="P" checked>
                      <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                    </div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tamatan</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="tamatan">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="jabatan">
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