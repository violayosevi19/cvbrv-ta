@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Jenis Produk')
@section('JudulTabel','Jenis Produk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Create Jenis Produk</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/jenisproduk-dash" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label @error ('jenis') is-invalid @enderror">Jenis Produk</label>
                    <select class="form-select" id="jenis" name="jenis">
                      <option value="Kosmetik">Kosmetik</option>
                      <option value="Beauty">Beauty</option>
                      <option value="Pewangi">Pewangi</option>
                      <option value="Kesehatan">Kesehatan</option>
                    </select>
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