<div id="scrollbar">
    <div class="container-fluid">
        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">Dashboard</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{route('dashboard')}}">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                </a>
            </li>
            <!-- end Dashboard Menu -->

            @if (Auth::user()->role == 'admin')
            <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarUsers">
                    <i class="ri-user-line"></i> <span data-key="t-authentication">Data Pengguna</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarUsers">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{route('users')}}" class="nav-link" data-key="t-one-page"> Kelola Pengguna </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarPesanan" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPesanan">
                    <i class="ri-table-line"></i> <span data-key="t-authentication">Kelola Pesanan</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarPesanan">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('kelola.pesanan') }}" class="nav-link" data-key="t-one-page"> Data Pesanan </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporantransaksi') }}" class="nav-link" data-key="t-one-page"> Laporan Data Transaksi </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                    <i class="ri-table-line"></i> <span data-key="t-authentication">Kelola Produk</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarAuth">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{ route('products') }}" class="nav-link" data-key="t-one-page"> Lihat Produk </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('category') }}" class="nav-link" data-key="t-one-page"> Kategori Produk </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLanding">
                    <i class="ri-rocket-line"></i> <span data-key="t-landing">Setting Percetakan</span>
                </a>
                <div class="collapse menu-dropdown" id="sidebarLanding">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="{{route('settingperusahan')}}" class="nav-link" data-key="t-one-page"> Ubah Profile Percetakan </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('pembayaran') }}" class="nav-link" data-key="t-one-page"> Setting Pembayaran </a>
                        </li>
                    </ul>
                </div>
            </li>
            @elseif(Auth::user()->role == 'user')
            <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Menu</span></li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{route('product.semua')}}">
                    <i class="ri-table-line"></i> <span data-key="t-authentication">Data Produk</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{route('pesanan')}}">
                    <i class="ri-table-line"></i> <span data-key="t-authentication">Data Pesanan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link menu-link" href="{{route('dashboard')}}">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Cek resi pesanan</span>
                </a>
            </li>
            @endif

        </ul>
    </div>
    <!-- Sidebar -->
</div>