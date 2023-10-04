@extends('layout.master')
@section('title','Halaman Tambah Data Petugas')
@section('content')
    <div class="content-wrapper">
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Form Tambah Data Petugas</h3>
                            </div>
                            <div class="card-body">
                                <form action="/petugas/store" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" name="nama" type="text" placeholder="Masukkan Nama">
                                        @if ($errors->first('nama'))
                                            * <p class="text-danger">{{ $errors->first('nama') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="username" type="text" placeholder="Masukkan Username">
                                        @if ($errors->first('username'))
                                            * <p class="text-danger">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="password" type="password" placeholder="Masukkan Password">
                                        @if ($errors->first('password'))
                                            * <p class="text-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Telp</label>
                                        <input class="form-control" name="no_telp" type="text" placeholder="Masukkan No Telp">
                                        @if ($errors->first('no_telp'))
                                            * <p class="text-danger">{{ $errors->first('no_telp') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" type="text" placeholder="Masukkan Email">
                                        @if ($errors->first('email'))
                                            * <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection