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
                    <select class="form-select" id="jenisBarang" name="jenisBarang_first"
                        aria-label="Default select example">
                        <option value="">Pilih jenis barang</option>
                        @foreach ($jenisBarangData as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jenisBarang" class="form-label">Jenis Barang 2</label>
                    <select class="form-select" id="jenisBarang" name="jenisBarang_second"
                        aria-label="Default select example">
                        <option value="">Pilih jenis barang</option>
                        @foreach ($jenisBarangData as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Date Filter --}}
                <hr>
                <div class="row my-3">
                    <label class="form-label fs-5">Pilih rentang tanggal transaksi</label>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="start_date" class="form-label">Start date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="end_date" class="form-label">End date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var today = new Date().toISOString().split('T')[0];

        document.getElementById("start_date").setAttribute("max", today);
        document.getElementById("end_date").setAttribute("max", today);
    </script>
@endpush
