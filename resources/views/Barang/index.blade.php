@extends('layout.master')
@section('title','Halaman Kelola Data Barang')
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
                                <h3>Kelola Data Barang</h3>
                                <a href="/barang/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-stripped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Perusahaan</th>
                                            <th>Supplier</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barang as $b)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->jenis }}</td>
                                                <td>{{ $b->stok }}</td>
                                                <td>Rp.{{ number_format($b->harga,2,',','.') }}</td>
                                                <td>{{ $b->Supplier->nama_perusahaan }}</td>
                                                <td>{{ $b->Supplier->nama }}</td>
                                                <td>
                                                    <a href="/barang/{{ $b->id }}/show" class="btn btn-warning">Edit</a>
                                                    <a href="/barang/{{ $b->id }}/destroy" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Data')">Hapus</a>
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