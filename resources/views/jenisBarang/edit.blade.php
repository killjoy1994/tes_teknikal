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
            <h2>Edit Jenis Barang <a class="float-end btn btn-danger" href="/jenis-barang">Back</a></h2>
        </div>
        <div class="card-body">
            <form action="{{ '/jenis-barang/' . $jenisBarang->id }}" method="POST">
                @csrf
                @method("PUT")
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama jenis barang</label>
                    <input type="text" class="form-control" id="nama" placeholder="Masukkan nama jenis barang..." value="{{ $jenisBarang->nama }}"
                        name="nama">
                </div>
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
        </div>
    </div>
@endsection
