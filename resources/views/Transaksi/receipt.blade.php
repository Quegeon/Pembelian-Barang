<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Struk Transaksi</title>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 5px; 
        }

        .grid-column-1 {
            text-align: left;
        }

        .grid-column-2 {
            text-align: right;
        }
    </style>
</head>
<body onload="window.print()">
    <center>
        <h1>Struk Transaksi</h1>
        <br>
        <hr>
        <br>
        <div class="grid-container">
            <div class="grid-column-1">
                <h4>Customer :</h4>
                <h4>Barang :</h4>
                <h4>Harga Barang :</h4>
                <h4>Kuantitas Pembelian :</h4>
                <h4>Total Harga :</h4>
                <h4>Tanggal Bayar :</h4>
                <h4>Petugas :</h4>
                <h4>Catatan :</h4>
            </div>
            <div class="grid-column-2">
                <h4>{{ $transaksi->id_customer }} | {{ $transaksi->Customer->username }}</h4>
                <h4>{{ $transaksi->Barang->nama_barang }} | {{ $transaksi->Barang->Supplier->nama_perusahaan }}</h4>
                <h4>Rp.{{ number_format($transaksi->Barang->harga,2,',','.') }}</h4>
                <h4>{{ $transaksi->kuantitas }}</h4>
                <h4>Rp.{{ number_format($transaksi->total_harga,2,',','.') }}</h4>
                <h4>{{ $transaksi->tanggal_bayar }}</h4>
                <h4>{{ $transaksi->Petugas->username }} | {{ $transaksi->Petugas->nama }}</h4>
                <h4>{{ $transaksi->catatan }}</h4>
            </div>
        </div>
        <br>
        <br>
        <hr>
    </center>
</body>
</html>