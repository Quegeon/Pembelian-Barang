@extends('layout.master')
@section('title','Halaman Kelola Data Customer')
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
                                <h3>Kelola Data Customer</h3>
                                <a href="/customer/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="card-body">
                                <table class="table table-stripped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No Telp</th>
                                            <th>Email</th>
                                            <th>Alamat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer as $c)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $c->id_customer }}</td>
                                                <td>{{ $c->nama }}</td>
                                                <td>{{ $c->username }}</td>
                                                <td>{{ $c->no_telp }}</td>
                                                <td>{{ $c->email }}</td>
                                                <td>{{ $c->alamat }}</td>
                                                <td>
                                                    <a href="/customer/{{ $c->id_customer }}/show" class="btn btn-warning">Edit</a>
                                                    <a href="/customer/{{ $c->id_customer }}/show/password" class="btn btn-warning">Ubah Password</a>
                                                    <a href="/customer/{{ $c->id_customer }}/destroy" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Data')">Hapus</a>
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