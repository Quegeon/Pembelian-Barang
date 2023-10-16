@extends('layout.master')
@section('title','Dashboard Supplier')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard Supplier</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          {{-- something here... --}}
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $sum_barang }}</h3>

              <p>Jumlah Barang</p>
            </div>
            <div class="icon">
              <i class="ion ion-cube"></i>
            </div>
            <a href="/barang" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
  </section>


  <section class="content">
  <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                  <h3>Barang Dijual</h3>
              </div>
              <div class="card-body">
              <table id="example" class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Barang</th>
                    <th>Harga Barang</th>
                    <th>Stok</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($supplier_barang as $sb)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $sb->nama_barang }}</td>
                        <td>{{ $sb->harga }}</td>
                        <td>{{ $sb->stok }}</td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
          </div>
      </div>
  </div>
  </section>

</div>
@endsection