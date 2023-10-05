<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan Transaksi</title>
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap:  5px;
        }

        .grid-column-1 {
            text-align: center;
            margin-right: 240px;
        }

        .grid-column-2 {
            text-align: center;
            margin-left: 240px;
        }
    </style>
</head>
<body onload="window.print()">
    <center>
        <h1>Laporan Transaksi {{ $bulan }} {{ $tahun }}</h1>
        <br>
        <hr>
        <br>
        <table border="1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Customer</th>
                    <th>Barang</th>
                    <th>Harga Barang</th>
                    <th>Kuantitas Pembelian</th>
                    <th>Total Harga</th>
                    <th>Tanggal Bayar</th>
                    <th>Petugas</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi as $t)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $t->id_customer }} | {{ $t->Customer->username }}</td>
                        <td>{{ $t->Barang->nama_barang }} | {{ $t->Barang->Supplier->nama_perusahaan }}</td>
                        <td>Rp.{{ number_format($t->Barang->harga,2,',','.') }}</td>
                        <td>{{ $t->kuantitas }}</td>
                        <td>Rp.{{ number_format($t->total_harga,2,',','.') }}</td>
                        <td>{{ $t->tanggal_bayar }}</td>
                        <td>{{ $t->Petugas->username }} | {{ $t->Petugas->nama }}</td>
                        <td>{{ $t->catatan }}</td>
                @endforeach
            </tbody>
        </table>
        <br>
        <hr>
        <br>
    </center>
    <div class="grid-container">
        <div class="grid-column-1">
            <p>TTD Admin</p>
            <br>
            <br>
            <br>
            <br>
            <p>.......................</p>
            <p>Nama: .......................</p>
        </div>
        <div class="grid-column-2">
            <p>TTD Petugas</p>
            <br>
            <br>
            <br>
            <br>
            <p>.......................</p>
            <p>Nama: .......................</p>
        </div>
    </div>
</body>
</html>