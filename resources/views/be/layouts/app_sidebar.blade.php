<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            {{-- <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/be/images/logos/logo.png') }}" width="60" alt="logo" />
            </a> --}}
            <h4 class="fw-bolder text-uppercase">NETTARE JUICE</h4>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                @php
                    $role = Session::get('user_session')['role'];
                @endphp
                @if ($role == 'admin' || $role == 'kasir')
                    <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">Home</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('be.dashboard') }}" aria-expanded="false">
                            <iconify-icon icon="solar:widget-add-line-duotone"></iconify-icon>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <span class="sidebar-divider lg"></span>
                    </li>
                    <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">TRANSACTION</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('be.transaksi.list') }}" aria-expanded="false">
                            {{-- <iconify-icon icon="solar:round-transfer-horizontal-linear"></iconify-icon> --}}
                            <iconify-icon icon="solar:cart-large-2-linear"></iconify-icon>
                            <span class="hide-menu">Transaksi</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('be.riwayat.list') }}" aria-expanded="false">
                            <iconify-icon icon="solar:clock-circle-linear"></iconify-icon>
                            <span class="hide-menu">Riwayat</span>
                        </a>
                    </li>
                @endif
                @if ($role == 'admin')
                    <li>
                        <span class="sidebar-divider lg"></span>
                    </li>
                    <li class="nav-small-cap">
                        <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                        <span class="hide-menu">MASTER DATA</span>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('be.menu.list') }}" aria-expanded="false">
                            <iconify-icon icon="solar:layers-minimalistic-linear"></iconify-icon>
                            <span class="hide-menu">Menu</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('be.kategori.list') }}" aria-expanded="false">
                            <iconify-icon icon="solar:box-linear"></iconify-icon>
                            <span class="hide-menu">Kategori</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Request::is('dashboard/petugas*') ? 'active' : '' }}"
                            href="{{ route('be.petugas.list') }}" aria-expanded="false">
                            <iconify-icon icon="solar:user-circle-linear"></iconify-icon>
                            <span class="hide-menu">Petugas</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('be.laporan.list') }}" aria-expanded="false">
                            <iconify-icon icon="solar:book-bookmark-outline"></iconify-icon>
                            <span class="hide-menu">Laporan</span>
                        </a>
                    </li>
                @endif
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

                <li class="nav-small-cap">
                    <iconify-icon icon="solar:menu-dots-linear" class="nav-small-cap-icon fs-4"></iconify-icon>
                    <span class="hide-menu">AUTH</span>
                </li>

                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('auth.act_logout') }}" aria-expanded="false">
                        <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                        <span class="hide-menu">Logout</span>
                    </a>
                </li>
                <li>
                    <span class="sidebar-divider lg"></span>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
