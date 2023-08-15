@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Pegawai')
@section('JudulTabel','Pegawai')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
        <h4 class="mx-3 text-center">Edit Data Pegawai</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-12">
                <form action="/pegawai-dash/{{ $pegawais->id }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="row">
                      <div class="col col-md-6">
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Id Pegawai</label>
                          <input type="text" class="form-control @error ('idpegawai') is-invalid @enderror" id="idpegawai" name="idpegawai" value="{{ old('idpegawai',$pegawais->idpegawai) }}">
                        </div>
                        @error('idpegawai')
                          {{ $message }}
                        @enderror
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Nama Pegawai</label>
                          <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama',$pegawais->nama) }}">
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Tanggal Lahir</label>
                          <input type="date" class="form-control" id="tgllahir" name="tgllahir" value="{{ old('tgllahir',$pegawais->
                          tgllahir) }}">
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jekel" id="jekel" value="L" checked>
                            <label class="form-check-label" for="inlineCheckbox1">Laki-Laki</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jekel" id="jekel" value="P" checked>
                            <label class="form-check-label" for="inlineCheckbox2">Perempuan</label>
                          </div>
                        </div>
                      </div>
                      <div class="col col-md-6">
                          <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Tamatan (Pendidikan Terakhir)</label>
                          <select class="form-select" id="tamatan" name="tamatan">
                            <option value="SLTP/Sederajat" @if(old('tamatan', $pegawais->tamatan) === "SLTP/Sederajat") selected @endif>SLTP/Sederajat</option>
                            <option value="SMA/SLTA Sederajat" @if(old('tamatan', $pegawais->tamatan) === "SMA/SLTA Sederajat") selected @endif>SMA/SLTA Sederajat</option>
                            <option value="Diploma I/II" @if(old('tamatan', $pegawais->tamatan) === "Diploma I/II") selected @endif>Diploma I/II</option>
                            <option value="Akademi/Diploma III/S. Muda" @if(old('tamatan', $pegawais->tamatan) === "Akademi/Diploma III/S. Muda") selected @endif>Akademi/Diploma III/S. Muda</option>
                            <option value="DilpomaIV/Strata I" @if(old('tamatan', $pegawais->tamatan) === "DilpomaIV/Strata I") selected @endif>DilpomaIV/Strata I</option>
                            <option value="Strata II" @if(old('tamatan', $pegawais->tamatan) === "Strata II") selected @endif>Strata II</option>
                            <option value="Strata III" @if(old('tamatan', $pegawais->tamatan) === "Strata III") selected @endif>Strata III</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                          <select class="form-select" id="jabatan" name="jabatan">
                            <option value="Manajer Distribusi" @if(old('jabatan', $pegawais->jabatan) === "Manajer Distribusi") selected @endif>Manajer Distribusi</option>
                            <option value="Koordinator Gudang" @if(old('jabatan', $pegawais->jabatan) === "Koordinator Gudang") selected @endif>Koordinator Gudang</option>
                            <option value="Administrasi" @if(old('jabatan', $pegawais->jabatan) === "Administrasi") selected @endif>Administrasi</option>
                            <option value="Pengemudi/Supir" @if(old('jabatan', $pegawais->jabatan) === "Pengemudi/Supir") selected @endif>Pengemudi/Supir</option>
                            <option value="Sales Representative" @if(old('jabatan', $pegawais->jabatan) === "Sales Representative") selected @endif>Sales Representative</option>
                            <option value="Staff Penerimaan Barang" @if(old('jabatan', $pegawais->jabatan) === "Staff Penerimaan Barang") selected @endif>Staff Penerimaan Barang</option>
                            <option value="Manajer Penjualan" @if(old('jabatan', $pegawais->jabatan) === "Manajer Penjualan") selected @endif>Manajer penjualan</option>
                            <option value="Direksi" @if(old('jabatan', $pegawais->jabatan) === "Direksi") selected @endif>Direksi</option>
                            <option value="Supervisor" @if(old('jabatan', $pegawais->jabatan) === "Supervisor") selected @endif>Supervisor</option>
                            <option value="Owner" @if(old('jabatan', $pegawais->jabatan) === "Owner") selected @endif>Owner</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="ijazah" class="form-label">Upload Ijazah</label>
                          <input type="file"  class="form-control @error ('ijazah') is-invalid @enderror" id="ijazah" name="ijazah">
                        </div>
                          @error('ijazah')
                          <span class="text-xs text-danger mt-0">{{ $message }}</span>
                          @enderror
                      </div>
                  </div>
                 
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ old('alamat',$pegawais->alamat) }}</textarea>
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