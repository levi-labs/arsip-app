<nav class="pcoded-navbar">
    <div class="navbar-wrapper">
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
                <li data-username="dashboard Default Ecommerce CRM Analytics Crypto Project" class="nav-item active">
                    <a href="{{ url('/dashboard') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Master</label>
                </li>
                <li data-username="basic components Button Alert Badges breadcrumb Paggination progress Tooltip popovers Carousel Cards Collapse Tabs pills Modal Grid System Typography Extra Shadows Embeds"
                    class="nav-item pcoded-hasmenu">
                    <a href="javascript:" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-box"></i></span><span class="pcoded-mtext">Data Master</span></a>
                    <ul class="pcoded-submenu">
                        <li class=""><a href="{{ url('/kategori') }}" class="">Kategori</a></li>
                        <li class=""><a href="{{ url('/barang') }}" class="">Barang</a></li>
                        <li class=""><a href="{{ url('/barang-masuk') }}" class="">Barang Masuk</a></li>
                        {{-- <li class=""><a href="bc_breadcrumb-pagination.html" class="">Breadcrumb &
                                paggination</a></li>
                        <li class=""><a href="bc_collapse.html" class="">Collapse</a></li>
                        <li class=""><a href="bc_tabs.html" class="">Tabs & pills</a></li>
                        <li class=""><a href="bc_typography.html" class="">Typography</a></li>


                        <li class=""><a href="icon-feather.html" class="">Feather<span
                                    class="pcoded-badge label label-danger">NEW</span></a></li> --}}
                    </ul>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Supplier & Cabang</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item">
                    <a href="{{ url('/supplier') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-file-text"></i></span><span class="pcoded-mtext">Supplier</span></a>
                </li>
                <li data-username="Table bootstrap datatable footable" class="nav-item">
                    <a href="{{ url('/cabang') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-server"></i></span><span class="pcoded-mtext">Cabang</span></a>
                </li>
                {{-- <li class="nav-item pcoded-menu-caption">
                    <label>Chart & Maps</label>
                </li>
                <li data-username="Charts Morris" class="nav-item"><a href="chart-morris.html" class="nav-link "><span
                            class="pcoded-micon"><i class="feather icon-pie-chart"></i></span><span
                            class="pcoded-mtext">Chart</span></a></li>
                <li data-username="Maps Google" class="nav-item"><a href="map-google.html" class="nav-link "><span
                            class="pcoded-micon"><i class="feather icon-map"></i></span><span
                            class="pcoded-mtext">Maps</span></a></li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Pages</label>
                </li> --}}
                <li class="nav-item pcoded-menu-caption">
                    <label>Arsip Masuk & Keluar</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item">
                    <a href="{{ url('/arsip-masuk') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-arrow-down"></i></span><span class="pcoded-mtext">Arsip
                            Masuk</span></a>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item">
                    <a href="{{ url('/arsip-masuk') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-arrow-up"></i></span><span class="pcoded-mtext">Arsip
                            Keluar</span></a>
                </li>

                <li class="nav-item pcoded-menu-caption">
                    <label>User Management</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item">
                    <a href="{{ url('/users') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-users"></i></span><span class="pcoded-mtext">Daftar User</span></a>
                </li>
                <li class="nav-item pcoded-menu-caption">
                    <label>Report</label>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item">
                    <a href="{{ url('/reports') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-trending-down"></i></span><span class="pcoded-mtext">Report
                            Masuk</span></a>
                </li>
                <li data-username="form elements advance componant validation masking wizard picker select"
                    class="nav-item">
                    <a href="{{ url('/reports') }}" class="nav-link "><span class="pcoded-micon"><i
                                class="feather icon-trending-up"></i></span><span class="pcoded-mtext">Report
                            Keluar</span></a>
                </li>

                {{-- <li data-username="Sample Page" class="nav-item"><a href="sample-page.html" class="nav-link"><span
                            class="pcoded-micon"><i class="feather icon-sidebar"></i></span><span
                            class="pcoded-mtext">Sample
                            page</span></a></li>
                <li data-username="Disabled Menu" class="nav-item disabled"><a href="javascript:" class="nav-link"><span
                            class="pcoded-micon"><i class="feather icon-power"></i></span><span
                            class="pcoded-mtext">Disabled
                            menu</span></a></li> --}}
            </ul>
        </div>
    </div>
</nav>
