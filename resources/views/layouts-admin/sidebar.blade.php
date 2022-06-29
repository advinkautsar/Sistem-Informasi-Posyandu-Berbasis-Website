<nav class="main-sidebar ps-menu">
            <div class="sidebar-toggle action-toggle">
                <a href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </div>
            <div class="sidebar-opener action-toggle">
                <a href="#">
                    <i class="ti-angle-right"></i>
                </a>
            </div>
            <div class="sidebar-header">
                <div class="text">Posyandu</div>
                <div class="close-sidebar action-toggle">
                    <i class="ti-close"></i>
                </div>
            </div>
            <div class="sidebar-content">
                <ul>

                <li class="{{ request()->segment(2) === 'rekapitulasi' ? 'active' : '' }}"">

                <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{url('admin/dashboard')}}" class="">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
        
                    <li class="{{ request()->is('admin/rekapitulasi') ? 'active' : '' }}">

                        <a href="{{url('admin/rekapitulasi')}}" class="link">
                            <i class="ti-write"></i>
                            <span>Rekapitulasi</span>
                        </a>
                    </li>     
                    <li class="{{ request()->segment(2) === 'kelola_pengguna' ? 'active open' : '' }}">
                        <a href="" class="main-menu has-dropdown">
                            <i class="ti-user"></i>
                            <span>Kelola Data Pengguna</span>
                        </a>
                        <ul class="sub-menu {{ request()->segment(2) === 'kelola_pengguna' ? 'expand': '' }} ">
                            <li class="{{ request()->segment(2) === 'kelola_pengguna' && request()->segment(3) === 'dinkes' ? 'active': '' }}"><a href="{{route('dinkes.index')}}" class="link"><span>Dinas Kesehatan</span></a></li>
                            <li class="{{ request()->segment(2) === 'kelola_pengguna' && request()->segment(3) === 'petdes' ? 'active': '' }}"><a href="{{route('petdes.index')}}" class="link"><span>Petugas Desa</span></a></li>
                            <li class="{{ request()->segment(2) === 'kelola_pengguna' && request()->segment(3) === 'petpus' ? 'active': '' }}"><a href="{{route('petpus.index')}}" class="link"><span>Petugas Puskesmas</span></a></li>
                        </ul>
                    </li>
                    <li class="{{ request()->segment(2) === 'data_anak' ? 'active' : '' }}">
                        <a href="{{url('admin/data_anak')}}" class="link">
                            <i class="ti-bar-chart"></i>
                            <span>Data Anak Banyuwangi</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('admin/grafik_anak') ? 'active' : '' }}">
                        <a href="{{url('admin/grafik_anak')}}" class="link">
                            <i class="ti-write"></i>
                            <span>Grafik</span>
                        </a>
                       
                    </li>
                    
                </ul>
            </div>
        </nav>        