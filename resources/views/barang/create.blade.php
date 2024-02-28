@extends('layout.index');

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger mb-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-header p-3">
            <h2>Tambah Barang <a class="float-end btn btn-danger" href="/jenis-barang">Back</a></h2>
        </div>
        <div class="card-body">
            <form action="/barang" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="jenisBarang" class="form-label">Jenis Barang</label>
                    <select class="form-select" id="jenisBarang" name="jenis_barang_id" aria-label="Default select example">
                        <option value="">Pilih jenis barang</option>
                        @foreach ($jenisBarangData as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="nama_barang" class="form-label">Nama barang</label>
                    <input type="text" class="form-control" id="nama_barang" placeholder="Masukkan nama barang..."
                        name="nama_barang">
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok barang</label>
                    <input type="number" class="form-control" id="stok" placeholder="Masukkan jumlah stok barang..."
                        name="stok">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
