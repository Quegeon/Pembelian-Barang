@extends('layout.master')
@section('title','Halaman Tambah Data Supplier')
@section('content')
    <div class="content-wrapper">
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Form Tambah Data Supplier</h3>    
                            </div>
                            <div class="card-body">
                                <form action="/supplier/store" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" type="text" name="nama" placeholder="Masukkan Nama">
                                        @if ($errors->first('nama'))
                                            <p class="text-danger">* {{ $errors->first('nama') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" type="text" name="username" placeholder="Masukkan Username">
                                        @if ($errors->first('username'))
                                            <p class="text-danger">* {{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Perusahaan</label>
                                        <input class="form-control" type="text" name="nama_perusahaan" placeholder="Masukkan Nama Perusahaan">
                                        @if ($errors->first('nama_perusahaan'))
                                            <p class="text-danger">* {{ $errors->first('nama_perusahaan') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" type="password" name="password" placeholder="Masukkan Password">
                                        @if ($errors->first('password'))
                                            <p class="text-danger">* {{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Telp</label>
                                        <input class="form-control" type="text" name="no_telp" placeholder="Masukkan No Telp Perusahaan">
                                        @if ($errors->first('no_telp'))
                                            <p class="text-danger">* {{ $errors->first('no_telp') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="text" name="email" placeholder="Masukkan Email Perusahaan">
                                        @if ($errors->first('email'))
                                            <p class="text-danger">* {{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input class="form-control" type="text" name="alamat" placeholder="Masukkan Alamat Perusahaan">
                                        @if ($errors->first('alamat'))
                                            <p class="text-danger">* {{ $errors->first('alamat') }}</p>
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