<div class="col-md-2 bg-secondary p-2" style="min-height: 600px">
    <div
        class="p-2 list-custom {{ request()->route()->uri == '/' || request()->route()->uri == 'transaksi/create' || request()->has('search') || request()->has('sort_by') ? 'active' : '' }}">
        <a class="text-white text-center fs-4 d-block fw-bold list-custom-text text-decoration-none {{ request()->route()->uri == '/' || request()->route()->uri == 'transaksi/create' || request()->has('search') || request()->has('sort_by') ? 'text-active' : '' }}"
            href="/">Transaksi</a>
    </div>
    <div
        class="p-2 list-custom {{ request()->route()->uri == 'jenis-barang' || request()->route()->uri == 'jenis-barang/create' || request()->route()->uri == 'jenis-barang' . '/{id}/edit' ? 'active' : '' }}">
        <a class="text-white text-center fs-4 d-block fw-bold list-custom-text text-decoration-none {{ request()->route()->uri == 'jenis-barang' || request()->route()->uri == 'jenis-barang/create' || request()->route()->uri == 'jenis-barang' . '/{id}/edit' ? 'text-active' : '' }}"
            href="/jenis-barang">Jenis Barang</a>

    </div>
    <div class="p-2 list-custom {{ request()->route()->uri == 'barang' || request()->route()->uri == 'barang/create' || request()->route()->uri == 'barang' . '/{id}/edit' ? 'active' : '' }}">
        <a class="text-white text-center fs-4 d-block fw-bold list-custom-text text-decoration-none {{ request()->route()->uri == 'barang' || request()->route()->uri == 'barang/create' || request()->route()->uri == 'barang' . '/{id}/edit' ? 'text-active' : '' }}"
            href="/barang">Barang</a>
    </div>
</div>
