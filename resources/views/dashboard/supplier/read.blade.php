@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Supplier')
@section('JudulTabel','Supplier')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4 class="mx-3 text-center text-uppercase">Detail Data Supplier</h4>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0 col d-flex justify-content-center" >
            <div class="row col-6 mx-5 mt-3">
              <div class="col border border-success rounded" style="border:1px solid;">
                <table class="table no-bordered">
                    <tr class="text-center text-capitalize text-dark text-m ">
                        <th>Kode Supplier</th>
                        <td>:</td>
                        <td>{{$detailSupplier['kodesupplier']}}</td>
                    </tr>
                    <tr class="text-center text-capitalize text-dark text-m ">
                        <th>Nama Supplier</th>
                        <td>:</td>
                        <td>{{$detailSupplier['namasupplier']}}</td>
                    </tr>
                    <tr class="text-center text-capitalize text-dark text-m ">
                        <th>No Hp</th>
                        <td>:</td>
                        <td>{{$detailSupplier['nohp']}}</td>
                    </tr>
                    <tr class="text-center text-capitalize text-dark text-m ">
                        <th>Alamat</th>
                        <td>:</td>
                        <td>{{$detailSupplier['alamat']}}</td>
                    </tr>
                </table>
                <div class="card-header pb-0">
                  <h6 class="mx-3 text-center text-uppercase">Produk Tersedia</h6>
                </div>
                <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" >Kode Produk</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Produk</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($produks as $item)
                        <tr>
                            <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $item['kodeproduk'] }}</span>
                            </td>
                            <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $item['namaproduk'] }}</span>
                            </td>
                        </tr>
                @endforeach
                </tbody>
              </table>
              <div class="card-header pb-0 align-items-center ">
                  <a href="/barangmasuk-dash/create" class="btn btn-info text-secondary font-weight-bold text-xs text-white" data-toggle="tooltip" data-original-title="Edit user">
                      Masukkan Barang Masuk 
                  </a>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection