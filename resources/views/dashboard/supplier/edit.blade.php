@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Supplier')
@section('JudulTabel','Supplier')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Edit Supplier</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/supplier-dash/{{ $suppliers->id }}" method="post">
                  @csrf
                  @method('put')
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">Kode Supplier</label>
                    <input type="text" class="form-control @error ('kodesupplier') is-invalid @enderror" id="exampleFormControlInput1" name="kodesupplier" value="{{ old('kodesupplier',$suppliers->kodesupplier) }}">
                  </div>
                  @error('nonota')
                  {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="kodeproduk" class="form-label">No Nota</label>
                    <input type="text" class="form-control @error ('nonota') is-invalid @enderror" id="exampleFormControlInput1" name="nonota" value="{{ old('nonota',$suppliers->nonota) }}">
                  </div>
                  @error('nonota')
                  {{ $message }}
                  @enderror
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Supplier</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="namasupplier"  value="{{ old('namasupplier',$suppliers->namasupplier) }}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">No Hp</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="nohp" value="{{ old('nohp',$suppliers->nohp) }}">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="alamat" value="{{ old('alamat',$suppliers->alamat) }}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Faktur</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tglfaktur"  value="{{ old('tglfaktur',$suppliers->tglfaktur) }}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jatuh Tempo</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="jatuhtempo" value="{{ old('jatuhtempo',$suppliers->jatuhtempo) }}">
                  </div>
                   <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Total</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="total"  value="{{ old('total',$suppliers->total) }}">
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