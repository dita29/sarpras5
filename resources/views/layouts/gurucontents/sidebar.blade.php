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
                    Data Peminjaman
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="dataMaster" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('peminjamanguru.index') }}">Peminjam</a>
                    </nav>
                </div>

                {{-- Stok --}}


                <!-- Peminjaman -->
                {{-- <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#peminjaman"
                    aria-expanded="false" aria-controls="peminjaman">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Peminjaman
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="peminjaman" aria-labelledby="headingOne"
                    data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('peminjaman.index') }}">Peminjaman</a>
                        <a class="nav-link" href="{{ route('pengembalian.index') }}">Pengembalian</a>
                    </nav>
                </div> --}}
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div>
    </nav>
</div>
