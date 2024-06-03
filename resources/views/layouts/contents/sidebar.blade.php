<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>

                {{-- Produk --}}
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#dataMaster"
                    aria-expanded="false" aria-controls="dataMaster">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Data Semua Barang
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="dataMaster" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a>
                        <a class="nav-link" href="{{ route('produk.index') }}">Barang</a>
                    </nav>
                </div>

                {{-- Stok --}}
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#dataStok"
                    aria-expanded="false" aria-controls="dataStok">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Data Stok
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="dataStok" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('stok.index') }}">Stok</a>
                        <a class="nav-link" href="{{ route('stokIn.index') }}">Barang Masuk</a>
                        <a class="nav-link" href="{{ route('stokOut.index') }}">Riwayat Transaksi</a>
                    </nav>
                </div>

                <!-- Peminjaman -->


                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="{{ route('peminjaman.index') }}">Peminjaman</a>

                </nav>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
