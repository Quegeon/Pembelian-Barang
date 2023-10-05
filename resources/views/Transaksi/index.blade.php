@extends('layout.master')
@section('title','Halaman Kelola Data Transaksi')
@section('content')
    <div class="content-wrapper">
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        @if (session()->has('status'))
                            <div class="alert alert-{{ session('status.type') }}">
                                {{ session('status.message') }}
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h3>Kelola Data Transaksi</h3>
                                <a href="/transaksi/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-stripped table-bordered table-hover">
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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transaksi as $t)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $t->id_customer }} | {{ $t->Customer->username }}</td>
                                                <td>{{ $t->Barang->nama_barang }} | {{ $t->Barang->Supplier->nama_perusahaan }}</td>
                                                <td>Rp.{{ number_format($t->Barang->harga,2,',','.') }}</td>
                                                <td>{{ $t->kuantitas }}</td>
                                                <td>Rp.{{ number_format($t->total_harga,2,',','.') }}</td>
                                                <td>{{ $t->tanggal_bayar }}</td>
                                                <td>{{ $t->Petugas->username }} | {{ $t->Petugas->nama }}</td>
                                                <td>{{ $t->catatan }}</td>
                                                <td>
                                                    <a href="/transaksi/{{ $t->id }}/show" class="btn btn-warning">Edit</a>
                                                    <a href="/transaksi/{{ $t->id }}/destroy" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Data')">Hapus</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection