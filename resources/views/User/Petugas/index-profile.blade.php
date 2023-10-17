@extends('layout.master')
@section('title','Profile Petugas')
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
                                        <th>No Telp</th>
                                        <td>{{ Auth::user()->no_telp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Aksi</th>
                                        <td>
                                            <a href="/petugas/show/profile" class="btn btn-warning">Edit Profile</a>
                                            <a href="/petugas/{{ Auth::user()->id }}/show/password" class="btn btn-warning">Ubah Password</a>
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