@extends('layout.master')
@section('title','Halaman Edit Data Petugas')
@section('content')
    <div class="content-wrapper">
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Form Edit Data Petugas</h3>
                            </div>
                            <div class="card-body">
                                <form action="/petugas/{{  $petugas->id  }}/update" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" name="nama" type="text" placeholder="{{ $petugas->nama }}" value="{{ $petugas->nama }}">
                                        @if ($errors->first('nama'))
                                            * <p class="text-danger">{{ $errors->first('nama') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="username" type="text" placeholder="{{ $petugas->username }}" value="{{ $petugas->username }}">
                                        @if ($errors->first('username'))
                                            * <p class="text-danger">{{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Telp</label>
                                        <input class="form-control" name="no_telp" type="text" placeholder="{{ $petugas->no_telp }}" value="{{ $petugas->no_telp }}">
                                        @if ($errors->first('no_telp'))
                                            * <p class="text-danger">{{ $errors->first('no_telp') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" type="text" placeholder="{{  $petugas->email  }}" value="{{ $petugas->email }}">
                                        @if ($errors->first('email'))
                                            * <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Level</label>
                                        <select name="level" class="form-control">
                                            <option value="{{ $petugas->level }}">Default: {{ $petugas->level }}</option>
                                            <option value="admin">Admin</option>
                                            <option value="petugas">Petugas</option>
                                        </select>
                                        @if ($errors->first('level'))
                                            * <p class="text-danger">{{ $errors->first('level') }}</p>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection