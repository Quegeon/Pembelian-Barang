@extends('layout.master')
@section('title','Halaman Ubah Password')
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
                                <h3>Form Ubah Password</h3>
                            </div>
                            <div class="card-body">
                                <form action="/supplier/{{ $supplier->id_supplier }}/change_password" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input class="form-control" type="password" name="new_password" placeholder="Masukkan Password Baru">
                                        @if ($errors->first('new_password'))
                                            <p class="text-danger">* {{ $errors->first('new_password') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password" name="confirm_password" placeholder="Konfirmasi Password">
                                        @if ($errors->first('confirm_password'))
                                            <p class="text-danger">* {{ $errors->first('confirm_password') }}</p>
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