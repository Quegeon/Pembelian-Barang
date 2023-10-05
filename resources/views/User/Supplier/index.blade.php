@extends('layout.master')
@section('title','Halaman Kelola Data Supplier')
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
                                <h3>Kelola Data Supplier</h3>
                                <a href="/supplier/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Nama Perusahaan</th>
                                            <th>No Telp</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($supplier as $s)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $s->id_supplier }}</td>
                                                <td>{{ $s->nama }}</td>
                                                <td>{{ $s->username }}</td>
                                                <td>{{ $s->nama_perusahaan }}</td>
                                                <td>{{ $s->no_telp }}</td>
                                                <td>{{ $s->email }}</td>
                                                <td>{{ $s->alamat }}</td>
                                                <td>
                                                    <a href="/supplier/{{ $s->id_supplier }}/show" class="btn btn-warning">Edit</a>
                                                    <a href="/supplier/{{ $s->id_supplier }}/show/password" class="btn btn-warning">Ubah Password</a>
                                                    <a href="/supplier/{{ $s->id_supplier }}/destroy" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Data')">Hapus</a>
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