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
                <h2>Komparasi Data Jenis Barang</h2>
                <div class="">
                    <a class="btn btn-secondary text-light" href="/">Back to daftar transaksi</a>
                    <a class="btn btn-danger" href="/transaksi/compare">Back</a>
                </div>
            </div>

        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Jenis barang: {{ $jenisBarangPertama->nama }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                @if ($data1)
                                    <div class="col-md-6">
                                        <h5>Penjualan terendah</h5>
                                        <div class="p-3 bg-danger" style="height: 120px; min-height: 120px;">
                                            <p class="text-white m-0">Nama Barang: {{ $data1['nama_barang_terendah'] }}
                                            </p>
                                            <p class="text-white m-0">Total Penjualan:
                                                {{ $data1['penjualan_terendah'] }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Penjualan tertinggi</h5>
                                        <div class="p-3 bg-success" style="height: 120px; min-height: 120px;">
                                            <p class="text-white m-0">Nama Barang: {{ $data1['nama_barang_tertinggi'] }}
                                            </p>
                                            <p class="text-white m-0">Total Penjualan:
                                                {{ $data1['penjualan_tertinggi'] }}
                                            </p>
                                        </div>
                                    </div>
                                @else
                                <h5 class="text-center">Data pada tanggal {{ $start_date }} sd {{ $end_date }} kosong</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-center">Jenis barang: {{ $jenisBarangKedua->nama }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row mt-4">
                                @if ($data2)
                                <div class="col-md-6">
                                    <h5>Penjualan terendah</h5>
                                    <div class="p-3 bg-danger" style="height: 120px; min-height: 120px;">
                                        <p class="text-white m-0">Nama Barang: {{ $data2['nama_barang_terendah'] }}</p>
                                        <p class="text-white m-0">Total Penjualan: {{ $data2['penjualan_terendah'] }}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5>Penjualan tertinggi</h5>
                                    <div class="p-3 bg-success" style="height: 120px; min-height: 120px;">
                                        <p class="text-white m-0">Nama Barang: {{ $data2['nama_barang_tertinggi'] }}</p>
                                        <p class="text-white m-0">Total Penjualan: {{ $data2['penjualan_tertinggi'] }}
                                        </p>
                                    </div>
                                </div>
                                @else
                                    <h5 class="text-center">Data pada tanggal {{ $start_date }} sd {{ $end_date }} kosong</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
