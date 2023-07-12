@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Stock')
@section('JudulTabel','Stock')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Edit Stock Produk</h6>
          @if(session()->has('pesan'))
          <div class="alert alert-danger" role="alert">
            {{ session('pesan') }}
          </div>
          @endif
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/stock-dash/{{ $stocks->id}}" method="post">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control @error ('kodeproduk') is-invalid @enderror" id="exampleFormControlInput1" name="kodeproduk" value="{{ old('kodeproduk',$stocks->kodeproduk) }}">
                  </div>
                  @error('kodeproduk')
                  {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="namaproduk" value="{{ old('namaproduk',$stocks->namaproduk) }}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="satuan" value="{{ old('satuan',$stocks->satuan) }}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="harga" value="{{ old('harga',$stocks->harga) }}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Stock</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="stock" value="{{ old('stock',$stocks->stock) }}">
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