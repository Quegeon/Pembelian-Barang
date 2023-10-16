@extends('layout.master')
@section('title','List of Barang')
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
                                <h3>List Barang Available</h3>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis</th>
                                            <th>Stok</th>
                                            <th>Harga</th>
                                            <th>Perusahaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barang as $b)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $b->nama_barang }}</td>
                                                <td>{{ $b->jenis }}</td>
                                                <td>{{ $b->stok }}</td>
                                                <td>Rp.{{ number_format($b->harga,2,',','.') }}</td>
                                                <td>{{ $b->Supplier->nama_perusahaan }}</td>
                                                <td>
                                                    <a href="/customer/{{ $b->id }}/show-buy" class="btn btn-primary">Beli</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>    
                            </div>    
                        </div>    
                    </div>    
                </div>    
            </div>    
        </section>    
    </div>    
@endsection