@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Detail Orderan')
@section('JudulTabel','Detail Orderan')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3">Detail Orderan</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2"> 
          <div class="table-responsive p-0">
            <div class="row mx-5 mt-3">
              <div class="col" >
                <form action="/detailorderan-dash" method="post">
                  @csrf
                  <div class="mb-3 d-inline-flex">
                    <label for="kodeproduk" class="form-label">No Nota</label>
                    <input type="text" class="form-control @error ('nonota') is-invalid @enderror" id="exampleFormControlInput1" name="nonota"
                     value="{{$takeNotas[0]->nonota}}">
                  </div>
                  @error('nonota')
                  {{ $message }}
                  @enderror
                  <div class="mb-3 d-inline-flex">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal Pesan</label>
                    <input type="date" class="form-control" id="exampleFormControlInput1" name="tglpesan" value="{{$takeNotas[0]->tglpesan}}">
                  </div>
                  <div class="mb-3 d-inline-flex">
                    <label for="exampleFormControlInput1" class="form-label">Nama Toko</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" name="namatoko" value="{{$namaToko}}">
                  </div>
                  <div class="card-body px-0 pt-0 pb-2">
                      <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                          <thead>
                            <tr>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No Nota</th>
                              <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Toko</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alamat</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Faktur</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Harga</th>
                              <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($takeNotas as $items)
                            <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">{{$items->nonota}}</h6>
                                </div>
                              </div>
                            </td>
                            <td>
                              <p class="text-xs font-weight-bold mb-0">{{$items->namaproduk}}</p>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="badge badge-sm bg-gradient-secondary">pcs</span>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <span class="badge badge-sm bg-gradient-secondary">{{$items->jumlah}}</span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold">{{$items->harga}}</span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold">{{$items->jumlah * $items->harga}}</span>
                            </td>
                            <td class="align-middle text-center">
                              <span class="text-secondary text-xs font-weight-bold">{{$items->kodeproduk}}</span>
                            </td>
                          </tr>
                          @endforeach
                          <tr>
                            <td style="border:1px solid;" colspan="5" class="align-middle text-center">Total</td>
                            <td class="align-middle text-center">{{ $total }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="mb-3 mt-3 ms-2">
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