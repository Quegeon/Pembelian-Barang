<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In Supplier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/light.css">
</head>
<body>
    <form action="/signin/customer/store" method="post">
        @csrf
        <br>
        <div class="form-group">
            <label>Nama</label>
            <input class="form-control" name="nama" type="text" placeholder="Masukkan Nama">
            @if ($errors->first('nama'))
                <p class="text-danger">* {{ $errors->first('nama') }}</p>
            @endif
        </div>
        <br>
        <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="username" type="text" placeholder="Masukkan Username">
            @if ($errors->first('username'))
                <p class="text-danger">* {{ $errors->first('username') }}</p>
            @endif
        </div>
        <br>
        <div class="form-group">
            <label>Password</label>
            <input class="form-control" name="password" type="password" placeholder="Masukkan Password">
            @if ($errors->first('password'))
                <p class="text-danger">* {{ $errors->first('password') }}</p>
            @endif
        </div>
        <br>
        <div class="form-group">
            <label>No Telp</label>
            <input class="form-control" name="no_telp" type="text" placeholder="Masukkan No Telp">
            @if ($errors->first('no_telp'))
                <p class="text-danger">* {{ $errors->first('no_telp') }}</p>
            @endif
        </div>
        <br>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control" name="email" type="text" placeholder="Masukkan Email">
            @if ($errors->first('email'))
                <p class="text-danger">* {{ $errors->first('email') }}</p>
            @endif
        </div>
        <br>
        <div class="form-group">
            <label>Alamat</label>
            <input class="form-control" name="alamat" type="text" placeholder="Masukkan Alamat">
            @if ($errors->first('alamat'))
                <p class="text-danger">* {{ $errors->first('alamat') }}</p>
            @endif
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>