@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Jenis Produk')
@section('JudulTabel','Jenis Produk')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Edit Jenis Produk</h6>
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
                <form action="/jenisproduk-dash/{{ $jenisproduks->id}}" method="post">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="jenis" class="form-label">Jenis Produk</label>
                    <input type="text" class="form-control @error ('jenis') is-invalid @enderror" id="jenis" name="jenis" value="{{ old('jenis',$jenisproduks->jenis) }}">
                  </div>
                  <!-- <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label @error ('jenis') is-invalid @enderror">Jenis Produk</label>
                    <select class="form-select" id="jenis" name="jenis">
                      <option value="Kapas" @if(old('jenis',$jenisproduks->jenis) == 'Kapas') selected @endif>Kapas</option>
                      <option value="Cutton Bud" @if(old('jenis',$jenisproduks->jenis) == 'Cutton Bud') selected @endif>Cutton Bud</option>
                      <option value="Parfume Laundry" @if(old('jenis',$jenisproduks->jenis) == 'Parfume Laundry') selected @endif>Parfume Laundry</option>
                      <option value="Soap" @if(old('jenis',$jenisproduks->jenis) == 'Soap') selected @endif>Soap</option>
                      <option value="Spon Mandi" @if(old('jenis',$jenisproduks->jenis) == 'Spon Mandi') selected @endif>Spon Mandi</option>
                      <option value="Pensil Alis" @if(old('jenis',$jenisproduks->jenis) == 'Pensil Alis') selected @endif>Pensil Alis</option>
                      <option value="Lipstick" @if(old('jenis',$jenisproduks->jenis) == 'Lipstick') selected @endif>Lipstick</option>
                    </select>
                  </div> -->
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