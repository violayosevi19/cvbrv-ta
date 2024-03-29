@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Produk')
@section('JudulTabel','Produk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
        <h4 class="mx-3 text-center">Edit Produk</h4>
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
                <form action="/produk-dash/{{ $produks->id}}" method="post">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">Kode Produk</label>
                    <input type="text" class="form-control @error ('kodeproduk') is-invalid @enderror" id="exampleFormControlInput1" name="kodeproduk" value="{{ old('kodeproduk',$produks->kodeproduk) }}">
                  </div>
                  @error('kodeproduk')
                  {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="namaproduk" value="{{ old('namaproduk',$produks->namaproduk) }}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="harga" value="Rp{{ number_format(old('harga',$produks->harga),0,',','.') }}">
                  </div>
                 <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Produk</label>
                    <select class="form-select" id="jenisproduk_id" name="jenisproduk_id">
                      @foreach($jenisproduks as $jp)
                      <option value="{{ old('jenisproduk_id',$jp->id) }}" @if(($jp->id) == (old('jenisproduk_id',$produks->jenisproduk_id)))  selected @endif>{{ $jp->jenis }}</option>
                      @endforeach
                    </select>
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