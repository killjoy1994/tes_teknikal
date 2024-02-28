<div class="col-md-2 bg-secondary p-2" style="min-height: 600px">
    <div class="p-2 list-custom {{ request()->route()->uri == '/' ? 'active' : '' }}">
        <a class="text-white text-center fs-4 d-block fw-bold list-custom-text text-decoration-none {{ request()->route()->uri == '/' ? 'text-active' : '' }}"
            href="/">Transaksi</a>
    </div>
    <div class="p-2 list-custom {{ request()->route()->uri == '/jenis-barang' ? 'active' : '' }}">
        <a class="text-white text-center fs-4 d-block fw-bold list-custom-text text-decoration-none {{ request()->route()->uri == '/jenis-barang' ? 'text-active' : '' }}"
            href="/jenis-barang">Jenis Barang</a>

    </div>
    <div class="p-2 list-custom {{ request()->route()->uri == '/barang' ? 'active' : '' }}">
        <a class="text-white text-center fs-4 d-block fw-bold list-custom-text text-decoration-none {{ request()->route()->uri == '/barang' ? 'text-active' : '' }}"
            href="/barang">Barang</a>
    </div>
</div>