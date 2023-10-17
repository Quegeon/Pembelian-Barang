@extends('layout.master')
@section('title','Profile Supplier')
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
                                <h3>Profil {{ Auth::user()->username }}</h3>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-striped">
                                    <tr>
                                        <th>Nama</th>
                                        <td>{{ Auth::user()->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td>{{ Auth::user()->username }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Perusahaan</th>
                                        <td>{{ Auth::user()->nama_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>No Telp</th>
                                        <td>{{ Auth::user()->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ Auth::user()->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Aksi</th>
                                        <td>
                                            <a href="/supplier/show/profile" class="btn btn-warning">Edit Profile</a>
                                            <a href="/supplier/{{ Auth::user()->id_supplier }}/show/password" class="btn btn-warning">Ubah Password</a>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection