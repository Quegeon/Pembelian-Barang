@extends('layout.master')
@section('title','Halaman Tambah Data Transaksi')
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
                                <h3>Form Tambah Data Transaksi</h3>
                            </div>
                            <div class="card-body">
                                <form action="/transaksi/store" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Customer</label>
                                        <select name="id_customer" class="form-control">
                                            @foreach ($customer as $c)
                                                <option value="{{ $c->id_customer }}">{{ $c->id_customer }} | {{ $c->nama }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->first('id_customer'))
                                            <p class="text-danger">* {{ $errors->first('id_customer') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Barang</label>
                                        <select name="id_barang" class="form-control">
                                            @foreach ($barang as $b)
                                                <option value="{{ $b->id }}">{{ $b->nama_barang }} | {{ $b->Supplier->nama_perusahaan }} | Rp.{{ number_format($b->harga,2,',','.') }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->first('id_barang'))
                                            <p class="text-danger">* {{ $errors->first('id_barang') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Kuantitas Pembelian</label>
                                        <input class="form-control" name="kuantitas" type="number" placeholder="Masukkan Kuantitas Pembelian" min="1">
                                        @if ($errors->first('kuantitas'))
                                            <p class="text-danger">* {{ $errors->first('kuantitas') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Petugas</label>
                                        <select name="id_petugas" class="form-control">
                                            @foreach ($petugas as $p)
                                                <option value="{{ $p->id }}">{{ $p->username }} | {{ $p->nama }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->first('id_petugas'))
                                            <p class="text-danger">* {{ $errors->first('id_petugas') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" name="catatan" class="form-control" placeholder="Masukkan Catatan Transaksi">
                                        @if ($errors->first('catatan'))
                                            <p class="text-danger">* {{ $errors->first('catatan') }}</p>
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