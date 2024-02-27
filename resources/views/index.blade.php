<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            min-height: 100vh;
            justify-content: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary mb-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <h1 class="fw-bold text-secondary">Test Qtasnim</h1>
            </a>
        </div>
    </nav>
    <div class="container">

    </div>

    <div class="container mt-5">
        @if (session('message'))
            <div class="alert alert-success mb-3">
                <h5>{{ session('message') }}</h5>
            </div>
        @endif
        <div class="card">
            <div class="card-header p-3">
                <h2>Data Transaksi <a class="float-end btn btn-primary" href="/transaksi/create">Tambah Data</a></h2>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Barang</th>
                            <th>Stok</th>
                            <th>Jumlah Terjual</th>
                            <th>Tanggal Transaksi</th>
                            <th>Jenis Barang</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksiData as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->barang->nama_barang }}</td>
                                <td>{{ $item->barang->stok }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->barang->jenisBarang->nama }}</td>
                                <td>
                                    <a href="{{ '/transaksi/'.$item->id.'/edit' }}" class="btn btn-success btn-sm">Edit</a>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">
                                    <h5 class="text-center">Data transaksi kosong.</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
