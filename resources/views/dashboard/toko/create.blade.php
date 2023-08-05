@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Toko')
@section('JudulTabel','Toko')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Create Data Toko</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col col-md-6">
                <form action="/toko-dash" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Id Toko</label>
                    <input type="text" class="form-control @error ('id_toko') is-invalid @enderror" id="exampleFormControlInput1" name="id_toko">
                  </div>
                  @error('id_toko')
                    {{ $message }}
                  @enderror
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="namatoko">
                  </div>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Alamat</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="alamat"></textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="notelp">
                  </div>
                  <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="email">
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