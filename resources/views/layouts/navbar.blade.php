<nav class="pcoded-navbar">
    <div class="navbar-wrapper d-print-none">
        <style>
            .title-tirta {
                font-size: 14px !important;
            }

            .b-bg .b-img {
                width: 40% !important;
            }
        </style>
        <div class="title-tirta b-brand text-center">

            <a href="/dashboard" class="">
                {{-- <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div> --}}
                <div class="b-bg">
                    <img class="b-img" src="{{ asset('/assets/images/logotirta.png') }}" alt="" width="30%">
                </div>
                <div class="text-center">
                    <span class="b-title">Tirta Multi Bangunan</span>
                </div>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
        <div class="navbar-content scroll-div">
            <ul class="nav pcoded-inner-navbar">
                <li class="nav-item pcoded-menu-caption">
                    <label>Navigation</label>
                </li>
                <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project"
                    class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ url('/dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Master</label>
                </li>
                <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds"
                    class="nav-item pcoded-hasmenu {{ request()->is(
                        'kategori',
                        'tambah-kategori',
                        'edit-kategori/*',
                        'barang',
                        'tambah-barang',
                        'edit-barang/*',
                        'detail-barang/*',
                        'barang-masuk',
                        'daftar-detail-barang-masuk/*',
                        'tambah-barang-masuk',
                        'pilih-sumber-barang',
                        'detail-barang-masuk/*',
                        'edit-barang-masuk/*',
                        'barang-keluar',
                        'daftar-detail-barang-keluar/*',
                        'tambah-barang-keluar',
                        'pilih-tujuan-barang',
                        'detail-barang-keluar/*',
                        'edit-barang-keluar/*',
                    )
                        ? 'active pcoded-trigger'
                        : '' }}">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-box"></i></span><span class="pcoded-mtext">Data Master</span></a>
                    <ul class="pcoded-submenu">
                        <li
                            class="{{ request()->is('kategori', 'tambah-kategori', 'edit-kategori/*') ? 'active' : '' }}">
                            <a href="{{ url('/kategori') }}" class="">Kategori</a>
                        </li>
                        <li
                            class="{{ request()->is('barang', 'tambah-barang', 'edit-barang/*', 'detail-barang/*') ? 'active' : '' }}">
                            <a href="{{ url('/barang') }}" class="">Barang</a>
                        </li>
                        <li
                            class="{{ request()->is(
                                'barang-masuk',
                                'daftar-detail-barang-masuk/*',
                                'tambah-barang-masuk',
                                'pilih-sumber-barang',
                                'detail-barang-masuk/*',
                                'edit-barang-masuk/*',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="{{ url('/barang-masuk') }}" class="">Barang Masuk</a>
                        </li>
                        <li
                            class="{{ request()->is(
                                'barang-keluar',
                                'daftar-detail-barang-keluar/*',
                                'tambah-barang-keluar',
                                'pilih-tujuan-barang',
                                'detail-barang-keluar/*',
                                'edit-barang-keluar/*',
                            )
                                ? 'active'
                                : '' }}">
                            <a href="{{ url('/barang-keluar') }}" class="">Barang Keluar</a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Supplier & Cabang</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item {{ request()->is('supplier', 'tambah-supplier', 'edit-supplier/*') ? 'active' : '' }}">
                    <a href="{{ url('/supplier') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-file-text"></i></span><span class="pcoded-mtext">Supplier</span></a>
                </li>
                <li data-username="Table bootstrap datatable footable"
                    class="nav-item {{ request()->is('cabang', 'tambah-cabang', 'edit-cabang/*') ? 'active' : '' }}">
                    <a href="{{ url('/cabang') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-server"></i></span><span class="pcoded-mtext">Cabang</span></a>
                </li>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Arsip Masuk & Keluar</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item {{ request()->is('arsip-masuk', 'post-arsip-masuk', 'detail-arsip-masuk/*') ? 'active' : '' }} ">
                    <a href="{{ url('/arsip-masuk') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-arrow-down"></i></span><span class="pcoded-mtext">Arsip
                            Masuk</span></a>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item {{ request()->is('arsip-keluar', 'post-arsip-keluar', 'detail-arsip-keluar/*') ? 'active' : '' }}">
                    <a href="{{ url('/arsip-keluar') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-arrow-up"></i></span><span class="pcoded-mtext">Arsip
                            Keluar</span></a>
                </li>

                <li class="nav-item pcoded-menu-caption">
                    <label>User Management</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item {{ request()->is('daftar-user', 'tambah-user', 'edit-user/*') ? 'active' : '' }}">
                    <a href="{{ url('/daftar-user') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-users"></i></span><span class="pcoded-mtext">Daftar User</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Report</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item {{ request()->is('report-masuk', 'post-report-masuk') ? 'active' : '' }}">
                    <a href="{{ url('/report-masuk') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-trending-down"></i></span><span class="pcoded-mtext">Report
                            Masuk</span></a>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item {{ request()->is('report-keluar', 'post-report-keluar') ? 'active' : '' }}">
                    <a href="{{ url('/report-keluar') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-trending-up"></i></span><span class="pcoded-mtext">Report
                            Keluar</span></a>
                </li>

            </ul>
        </div>
    </div>
</nav>
