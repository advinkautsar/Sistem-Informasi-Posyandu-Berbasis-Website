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
    <div class="sidebar-header d-flex align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
            <img src="{{asset('public/arfa/assets/images/logo_web.png')}}" class="navbar-brand-img" alt="">
        </a>
        <!-- <div class="text" style="font-size: 12px; padding: 0;">Sistem Informasi Posyandu</div> -->
        <div class="close-sidebar action-toggle">
            <i class="ti-close"></i>
        </div>
    </div>
    <div class="sidebar-content">
        <ul>
            @if(auth()->user()->role == 'super_admin')
            <li class="{{ request()->segment(2) === 'dashboard_admin' ? 'active' : '' }}">
                <a href="{{route('dashboard_admin')}}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
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
                <a href="{{route('data_anak')}}" class="link">
                    <i class="ti-pin"></i>
                    <span>Data Anak Banyuwangi</span>
                </a>
            </li>
            <li class="{{ request()->segment(2) === 'rekapitulasi' ? 'active' : '' }}"">
                            <a href=" {{url('admin/rekapitulasi')}}" class="link">
                <i class="ti-files"></i>
                <span>Laporan rekapitulasi</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/grafik_anak') ? 'active' : '' }}">
                <a href="{{url('admin/grafik_anak')}}" class="link">
                    <i class="ti-stats-up"></i>
                    <span>Grafik</span>
                </a>

            </li>
            @endif



            @if(auth()->user()->role == 'petugas_puskesmas')
            <li class="{{ request()->segment(2) === 'dashboard_puskesmas' ? 'active' : '' }}">
                <a href="{{route('dashboard_puskesmas')}}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Dropdown -->
            <li class="{{ request()->segment(2) === 'kelola_data' ? 'active open' : '' }}">
                <a href="" class="main-menu has-dropdown">
                    <i class="ti-user"></i>
                    <span>Kelola Data</span>
                </a>
                <ul class="sub-menu {{ request()->segment(2) === 'kelola_data' ? 'expand': '' }} ">
                    <li class="{{ request()->segment(2) === 'kelola_data' && request()->segment(3) === 'posyandu' ? 'active': '' }}"><a href="{{route('posyandu.index')}}" class="link"><span>Kelola Posyandu</span></a></li>
                    <li class="{{ request()->segment(2) === 'kelola_data' && request()->segment(3) === 'bidan' ? 'active': '' }}"><a href="{{route('bidan.index')}}" class="link"><span>Kelola Bidan</span></a></li>
                    <li class="{{ request()->segment(2) === 'kelola_data' && request()->segment(3) === 'kader' ? 'active': '' }}"><a href="{{route('kader.index')}}" class="link"><span>Kelola Kader</span></a></li>
                    <li class="{{ request()->segment(2) === 'kelola_data' && request()->segment(3) === 'tips' ? 'active': '' }}"><a href="{{route('tips.index')}}" class="link"><span>Kelola Tips Kesehatan</span></a></li>
                </ul>
            </li>

            <li class="{{ request()->segment(2) === 'rekapitulasi_imunisasi' ? 'active' : '' }}">
                <a href="{{route('rekap_imunisasi')}}" class="link">
                    <i class="ti-layout"></i>
                    <span>Rekapan Imunisasi</span>
                </a>
            </li>
            @endif



            @if(auth()->user()->role == 'petugas_desa')
            <li class="{{ request()->segment(2) === 'dashboard_desa' ? 'active' : '' }}">
                <a href="{{route('dashboard_desa.index')}}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->segment(2) === 'kelola_ortu' ? 'active' : '' }}">
                <a href="{{route('kelola_ortu.index')}}" class="link">
                    <i class="ti-id-badge"></i>
                    <span>Kelola Orangtua</span>
                </a>
            </li>
            <li class="{{ request()->segment(2) === 'riwayat_pertumbuhan_anak' ? 'active' : '' }}">
                <a href="{{url('petugas_desa/riwayat_pertumbuhan_anak/index')}}" class="link">
                    <i class="ti-stats-up"></i>
                    <span>Riwayat Pertumbuhan Anak</span>
                </a>
            </li>
            <li class="{{ request()->segment(2) === 'laporan_posyandu' ? 'active' : '' }}">
                <a href="{{route('laporan_pos_index')}}" class="link">
                    <i class="ti-files"></i>
                    <span>Laporan Posyandu</span>
                </a>
            </li>
            @endif

            @if(auth()->user()->role == 'dinas_kesehatan')
            <li class="{{ request()->segment(2) === 'dashboard_dinkes' ? 'active' : '' }}">
                <a href="{{route('dashboard_dinkes')}}" class="link">
                    <i class="ti-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->segment(2) === 'data_anak' ? 'active' : '' }}">
                <a href="{{route('data_anak_dinkes')}}" class="link">
                    <i class="ti-pin"></i>
                    <span>Data Anak Banyuwangi</span>
                </a>
            </li>
            
            @endif
        </ul>
    </div>
</nav>