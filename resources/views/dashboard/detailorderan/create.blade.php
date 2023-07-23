@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Detail Orderan')
@section('JudulTabel','Detail Orderan')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Create Detail Orderan</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/detailorderan-dash" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">No Nota</label>
                    <input type="text" class="form-control @error ('nonota') is-invalid @enderror" id="exampleFormControlInput1" name="nonota">
                  </div>
                  @error('nonota')
                  {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="namaproduk">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jumlah</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="jumlah">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="harga">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Pesan</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tglpesan">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="kodeproduk">
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