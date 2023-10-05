@extends('layout.master')
@section('title','Halaman Edit Data Supplier')
@section('content')
    <div class="content-wrapper">
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Form Edit Data Supplier</h3>
                            </div>
                            <div class="card-body">
                                <form action="/supplier/{{  $supplier->id_supplier  }}/update" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input class="form-control" name="nama" type="text" placeholder="{{ $supplier->nama }}" value="{{ $supplier->nama }}">
                                        @if ($errors->first('nama'))
                                            <p class="text-danger">* {{ $errors->first('nama') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input class="form-control" name="username" type="text" placeholder="{{ $supplier->username }}" value="{{ $supplier->username }}">
                                        @if ($errors->first('username'))
                                            <p class="text-danger">* {{ $errors->first('username') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Perusahaan</label>
                                        <input class="form-control" name="nama_perusahaan" type="text" placeholder="{{ $supplier->nama_perusahaan }}" value="{{ $supplier->nama_perusahaan }}">
                                        @if ($errors->first('nama_perusahaan'))
                                            <p class="text-danger">* {{ $errors->first('nama_perusahaan') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>No Telp</label>
                                        <input class="form-control" name="no_telp" type="text" placeholder="{{ $supplier->no_telp }}" value="{{ $supplier->no_telp }}">
                                        @if ($errors->first('no_telp'))
                                            <p class="text-danger">* {{ $errors->first('no_telp') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" name="email" type="text" placeholder="{{  $supplier->email  }}" value="{{ $supplier->email }}">
                                        @if ($errors->first('email'))
                                            <p class="text-danger">* {{ $errors->first('email') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input class="form-control" name="alamat" type="text" placeholder="{{  $supplier->alamat  }}" value="{{ $supplier->alamat }}">
                                        @if ($errors->first('alamat'))
                                            <p class="text-danger">* {{ $errors->first('alamat') }}</p>
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