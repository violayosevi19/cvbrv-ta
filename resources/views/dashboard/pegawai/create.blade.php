@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Pegawai')
@section('JudulTabel','Pegawai')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4 class="mx-3 text-center">Tambahkan Data Pegawai</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-12">
                <form action="/pegawai-dash" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                    <div class="col col-md-6">
                      <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Id Pegawai</label>
                        <input type="text" class="form-control @error ('idpegawai') is-invalid @enderror" id="exampleFormControlInput1" name="idpegawai">
                      </div>
                      @error('idpegawai')
                       <span class="text-xs text-danger mt-0">{{ $message }}</span>
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
                    </div>
                    <div class="col col-md-6">
                          <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Tamatan (Pendidikan Terakhir)</label>
                          <select class="form-select" id="tamatan" name="tamatan">
                            <option value="SLTP/Sederajat">SLTP/Sederajat</option>
                            <option value="SMA/SLTA Sederajat">SMA/SLTA Sederajat</option>
                            <option value="Diploma I/II">Diploma I/II</option>
                            <option value="Akademi/Diploma III/S. Muda">Akademi/Diploma III/S. Muda</option>
                            <option value="DilpomaIV/Strata I">DilpomaIV/Strata I</option>
                            <option value="Strata II">Strata II</option>
                            <option value="Strata III">Strata III</option>
                          </select>
                        </div>
                        <div class="mb-3">
                          <label for="exampleFormControlInput1" class="form-label">Jabatan</label>
                          <select class="form-select" id="jabatan" name="jabatan">
                            <option value="Manajer Distribusi">Manajer Distribusi</option>
                            <option value="Koordinator Gudang">Koordinator Gudang</option>
                            <option value="Administrasi">Administrasi</option>
                            <option value="Pengemudi/Supir">Pengemudi/Supir</option>
                            <option value="Sales Representative">Sales Representative</option>
                            <option value="Staff Penerimaan Barang">Staff Penerimaan Barang</option>
                            <option value="Manajer Penjualan">Manajer penjualan</option>
                            <option value="Direksi">Direksi</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Owner">Owner</option>
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
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
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