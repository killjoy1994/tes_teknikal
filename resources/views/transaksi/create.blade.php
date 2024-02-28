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
            <h2>Tambah Transaksi Baru <a class="float-end btn btn-danger" href="/">Back</a></h2>
        </div>
        <div class="card-body">
            <form action="/transaksi" method="POST">
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
                    <label for="barang" class="form-label">Barang</label>
                    <select class="form-select" name="barang_id" id="barang" aria-label="Default select example">
                        <option value="">Pilih barang</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Jumlah Barang</label>
                    <input type="number" class="form-control" id="quantity" name="quantity"
                        placeholder="Masukkan jumlah barang..." aria-describedby="emailHelp">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        $('#jenisBarang').change(function() {
            // console.log("Hallo")
            var jenisBarangId = $(this).val();
            if (jenisBarangId) {
                $.ajax({
                    type: "GET",
                    url: "/fetchBarang?jenisBarangId=" + jenisBarangId,
                    dataType: 'JSON',
                    success: function(res) {
                        if (res.length !== 0) {
                            console.log(res);
                            $("#barang").empty();
                            // $("#jenisBarang").append('<option>---Pilih Barang---</option>');
                            $.each(res, function(name, id) {
                                $("#barang").append(`<option value=${id}>${name}</option`);
                            });
                        } else {
                            console.log(res);
                            $("#barang").empty();
                            // console.log("NOL VALUE")
                            $("#barang").append('<option value=""> Barang kosong</option>');
                        }
                    }
                });
            } else {
                $("#brand").empty();
            }
        });
    </script>
@endpush
