@extends('layout.index');

@section('content')
    @if (session('message'))
        <div class="alert alert-success mb-3">
            <h5>{{ session('message') }}</h5>
        </div>
    @endif
    <div class="card">
        <div class="card-header p-4">
            <div class="d-flex justify-content-between">
                <h2>Daftar Barang</h2>
                <div class="">
                    <a class="btn btn-success" href="/barang/create">Tambah Data</a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Barang</th>
                        <th>Jenis Barang</th>
                        <th>Stok Barang</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barang as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>{{ $item->jenisBarang->nama }}</td>
                            <td>{{ $item->stok }}</td>
                            <td>
                                <a href="{{ '/barang/' . $item->id . '/edit' }}" class="btn btn-success btn-sm">Edit</a>
                                <a href="{{ '/barang/' . $item->id . '/delete' }}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">
                                <h5 class="text-center">Data barang kosong.</h5>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
