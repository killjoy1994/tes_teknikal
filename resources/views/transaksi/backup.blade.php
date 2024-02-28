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
            background-color: #f3f3f3;
        }
    </style>
</head>

<body>
    @include('include.navbar')
    <div class="container mt-5">
        @if (session('message'))
            <div class="alert alert-success mb-3">
                <h5>{{ session('message') }}</h5>
            </div>
        @endif
        <div class="card">
            <div class="card-header p-4">
                <div class="d-flex justify-content-between">
                    <h2>Data Transaksi</h2>
                    <div class="">
                        <a class="ms-2 btn btn-primary text-white" href="/transaksi/create">Bandingkan Data</a>
                        <a class="btn btn-success" href="/transaksi/create">Tambah Data</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <div class="mb-4 row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-5">
                                <form action="/search-barang">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Cari barang..."
                                            name="search" aria-label="Recipient's username"
                                            aria-describedby="button-addon2">
                                        <button class="btn btn-outline-secondary" type="submit"
                                            id="button-addon2">Cari</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-7">
                                <form action="/sort-transaksi" method="GET">
                                    @csrf
                                    <div class="input-group mb-3">
                                        {{-- <label class="input-group-text" for="sort_by">Urutkan</label> --}}
                                        <select class="form-select" id="sort_by" name="sort_by">
                                            <option value="">Urutkan berdasarkan</option>
                                            <option
                                                {{ Request::input('sort_by') == 'nama_barang_asc' ? 'selected' : '' }}
                                                value="nama_barang_asc">Nama barang (a - z)</option>
                                            <option
                                                {{ Request::input('sort_by') == 'nama_barang_desc' ? 'selected' : '' }}
                                                value="nama_barang_desc">Nama barang (z - a)</option>
                                            <option
                                                {{ Request::input('sort_by') == 'tanggal_transaksi_desc' ? 'selected' : '' }}
                                                value="tanggal_transaksi_desc">Transaksi terbaru</option>
                                            <option
                                                {{ Request::input('sort_by') == 'tanggal_transaksi_asc' ? 'selected' : '' }}
                                                value="tanggal_transaksi_asc">Transaksi terlama</option>
                                        </select>
                                        <button type="submit" class="btn btn-outline-secondary">Urutkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <td>{{ $item->stok_sisa }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->barang->jenisBarang->nama }}</td>
                                <td>
                                    <a href="{{ '/transaksi/' . $item->id . '/edit' }}"
                                        class="btn btn-success btn-sm">Edit</a>
                                    <a href="{{ '/transaksi/' . $item->id . '/delete' }}"
                                        class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">
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
