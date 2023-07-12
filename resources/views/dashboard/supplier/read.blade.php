@extends('dashboard.layout.main')
@section('container')
@section('JudulPages','Supplier')
@section('JudulTabel','Supplier')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h6 class="mx-3 text-center">Detail Data Supplier</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0 col d-flex justify-content-center" >
            <div class="row mx-5 mt-3" style="border:1px solid;">
              <div class="col" style="border:1px solid;">
                <table class="table">
                    <tr>
                        <th>Nama Supplier</th>
                        <td>:</td>
                        <td>{{$detailSupplier[0]->namasupplier}}</td>
                    </tr>
                    <tr>
                        <th>No Hp</th>
                        <td>:</td>
                        <td>{{$detailSupplier[0]->nohp}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <td>{{$detailSupplier[0]->alamat}}</td>
                    </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endsection