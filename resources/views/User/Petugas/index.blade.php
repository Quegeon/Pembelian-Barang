@extends('layout.master')
@section('title','Halaman Kelola Data Petugas')
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
                                <h3>Kelola Data Petugas</h3>
                                <a href="/petugas/create" class="btn btn-primary">Tambah Data</a>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-stripped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>No Telp</th>
                                            <th>Email</th>
                                            <th>Level</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($petugas as $p)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $p->nama }}</td>
                                                <td>{{ $p->username }}</td>
                                                <td>{{ $p->no_telp }}</td>
                                                <td>{{ $p->email }}</td>
                                                <td>{{ $p->level }}</td>
                                                <td>
                                                    <a href="/petugas/{{ $p->id }}/show" class="btn btn-warning">Edit</a>
                                                    <a href="/petugas/{{ $p->id }}/show/password" class="btn btn-warning">Ubah Password</a>
                                                    <a href="/petugas/{{ $p->id }}/destroy" class="btn btn-danger" onclick="return confirm('Konfirmasi Hapus Data')">Hapus</a>
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