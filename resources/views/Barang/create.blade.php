@extends('layout.master')
@section('title','Halaman Tambah Data Barang')
@section('content')
    <div class="content-wrapper">
        <br>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Form Tambah Data Barang</h3>
                            </div>
                            <div class="card-body">
                                <form action="/barang/store" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <input class="form-control" name="nama_barang" type="text" placeholder="Masukkan Nama Barang">
                                        @if ($errors->first('nama_barang'))
                                            <p class="text-danger">* {{ $errors->first('nama_barang') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis</label>
                                        <select name="jenis" class="form-control">
                                            <option value="garmen">Garmen</option>
                                            <option value="konsumsi">Konsumsi</option>
                                            <option value="material">Material</option>
                                            <option value="perlengkapan">Perlengkapan</option>
                                            <option value="lainnya">Lainnya</option>
                                        </select>
                                        @if ($errors->first('jenis'))
                                            <p class="text-danger">* {{ $errors->first('jenis') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Stok</label>
                                        <input class="form-control" name="stok" type="text" placeholder="Masukkan Stok Barang">
                                        @if ($errors->first('stok'))
                                            <p class="text-danger">* {{ $errors->first('stok') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Harga</label>
                                        <input class="form-control" name="harga" type="text" placeholder="Masukkan Harga Barang">
                                        @if ($errors->first('harga'))
                                            <p class="text-danger">* {{ $errors->first('harga') }}</p>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        @if ( Auth::user()->level === 'supplier' )
                                            <input type="text" name="id_supplier" value="{{ Auth::user()->id_supplier }}" hidden>
                                        
                                        @else
                                            <label>Supplier</label>
                                            <select name="id_supplier" class="form-control">
                                                    @foreach ($supplier as $s)
                                                        <option value="{{ $s->id_supplier }}">{{ $s->nama }} | {{ $s->nama_perusahaan }}</option>                                                
                                                    @endforeach
                                                </select>
                                                @if ($errors->first('id_supplier'))
                                                    <p class="text-danger">* {{ $errors->first('id_supplier') }}</p>
                                                @endif

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