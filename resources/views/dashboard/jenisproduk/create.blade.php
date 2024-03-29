@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Jenis Produk')
@section('JudulTabel','Jenis Produk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4 class="mx-3 text-center">Tambah Jenis Produk</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/jenisproduk-dash" method="post">
                  @csrf
                  <!-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label @error ('jenis') is-invalid @enderror">Jenis Produk</label>
                    <select class="form-select" id="jenis" name="jenis">
                      <option value="Kapas">Kapas</option>
                      <option value="Cutton Bud">Cutton Bud</option>
                      <option value="Parfume Laundry">Parfume Laundry</option>
                      <option value="Soap">Soap</option>
                      <option value="Spon Mandi">Spon Mandi</option>
                      <option value="Pensil Alis">Pensil Alis</option>
                      <option value="Lipstick">Lipstick</option>
                    </select>
                  </div> -->
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Produk</label>
                    <input type="text" class="form-control" id="jenis" name="jenis">
                  </div>
                  @error('jenis')
                    {{ $message }}
                  @enderror
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