@extends('layout.master')
@section('title','Dashboard Admin')
@section('content')
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard Admin</h1>
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
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{  $sum_customer }}</h3>

              <p>Customer</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people-outline"></i>
            </div>
            <a href="/customer" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{ $sum_supplier }}</h3>

              <p>Supplier</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="/supplier" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
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
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>
                @if ($total_transaksi->tb === null)
                    Rp. 0
                @else
                    Rp.{{ number_format($total_transaksi->tb,2,',','.') }}
                @endif
              </h3>

              <p>Total Transaksi</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <a href="/transaksi" class="small-box-footer">Info Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
  </section>


  <section class="content">
  <div class="row">
      <div class="col-lg-12">
          <div class="card">
              <div class="card-header">
                  <h3>History Transaksi</h3>
              </div>
              <div class="card-body">
              <table id="example" class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Barang</th>
                    <th>Harga Barang</th>
                    <th>Kuantitas Pembelian</th>
                    <th>Total Harga</th>
                    <th>Tanggal Bayar</th>
                    <th>Petugas</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($history as $h)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $h->id_customer }} | {{ $h->Customer->nama }}</td>
                        <td>{{ $h->Barang->nama_barang }} | {{ $h->Barang->Supplier->nama_perusahaan }}</td>
                        <td>Rp.{{ number_format($h->Barang->harga,2,',','.') }}</td>
                        <td>{{ $h->kuantitas }}</td>
                        <td>Rp.{{ number_format($h->total_harga,2,',','.') }}</td>
                        <td>{{ $h->tanggal_bayar }}</td>
                        <td>{{ $h->Petugas->nama }}</td>
                        <td>{{ $h->catatan }}</td>
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