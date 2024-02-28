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
            <h2>Bandingkan Jenis Barang<a class="float-end btn btn-danger" href="/">Back</a></h2>
        </div>
        <div class="card-body">
            <form action="/transaksi/compare-data" method="GET">
                @csrf
                <div class="mb-3">
                    <label for="jenisBarang" class="form-label">Jenis Barang 1</label>
                    <select class="form-select" id="jenisBarang" name="jenisBarang_first" aria-label="Default select example">
                        <option value="">Pilih jenis barang</option>
                        @foreach ($jenisBarangData as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenisBarang" class="form-label">Jenis Barang 2</label>
                    <select class="form-select" id="jenisBarang" name="jenisBarang_second" aria-label="Default select example">
                        <option value="">Pilih jenis barang</option>
                        @foreach ($jenisBarangData as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
