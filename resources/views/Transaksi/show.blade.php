@extends('layout.master')
@section('title','Halaman Edit Data Transaksi')
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
                                <h3>Form Edit Data Transaksi</h3>
                            </div>
                            <div class="card-body">
                                <form action="/transaksi/{{ $transaksi->id }}/update" method="post">
                                    @csrf
                                    <div class="form-group">
                                        @if ( Auth::user()->level === 'customer' )
                                            <input type="text" name="id_customer" value="{{ Auth::user()->id_customer }}" hidden>
                                            
                                        @else
                                            <label>Customer</label>
                                            <select name="id_customer" class="form-control">
                                                <option value="{{ $transaksi->id_customer }}">Default: {{ $transaksi->id_customer }} | {{ $transaksi->Customer->username }}</option>
                                                @foreach ($customer as $c)
                                                    <option value="{{ $c->id_customer }}">{{ $c->id_customer }} | {{ $c->nama }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->first('id_customer'))
                                                <p class="text-danger">* {{ $errors->first('id_customer') }}</p>
                                            @endif
                                            
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Barang</label>
                                        <select name="id_barang" class="form-control">
                                            <option value="{{ $transaksi->id_barang }}">Default: {{ $transaksi->Barang->nama_barang }} | {{  $transaksi->Barang->Supplier->nama_perusahaan }} | Rp.{{ number_format($transaksi->Barang->harga,2,',','.') }}</option>
                                            @foreach ($barang as $b)
                                                <option value="{{ $b->id }}">{{ $b->nama_barang }} | {{ $b->Supplier->nama_perusahaan }} | {{ $b->harga }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->first('id_barang'))
                                            <p class="text-danger">* {{ $errors->first('id_barang') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Kuantitas Pembelian</label>
                                        <input class="form-control" name="kuantitas" type="number" placeholder="{{ $transaksi->kuantitas }}" min="1" value="{{ $transaksi->kuantitas }}">
                                        @if ($errors->first('kuantitas'))
                                            <p class="text-danger">* {{ $errors->first('kuantitas') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if ( Auth::user()->level === 'petugas' )
                                            <input type="text" name="id_petugas" value="{{ Auth::user()->id }}" hidden>

                                        @else
                                            <label>Petugas</label>
                                            <select name="id_petugas" class="form-control">
                                                <option value="{{ $transaksi->id_petugas }}">Default: {{ $transaksi->Petugas->username }} | {{ $transaksi->Petugas->nama }}</option>
                                                @foreach ($petugas as $p)
                                                    <option value="{{ $p->id }}">{{ $p->username }} | {{ $p->nama }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->first('id_petugas'))
                                                <p class="text-danger">* {{ $errors->first('id_petugas') }}</p>
                                            @endif
                                            
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Bayar</label>
                                        <input type="date" name="tanggal_bayar" class="form-control" placeholder="{{ $transaksi->tanggal_bayar }}" value="{{ $transaksi->tanggal_bayar }}">
                                        @if ($errors->first('tanggal_bayar'))
                                            <p class="text-danger">* {{ $errors->first('tanggal_bayar') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <input type="text" name="catatan" class="form-control" placeholder="{{ $transaksi->catatan }}" value="{{ $transaksi->catatan }}">
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