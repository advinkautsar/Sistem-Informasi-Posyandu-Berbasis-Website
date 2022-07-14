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
            @if(auth()->user()->role == 'super_admin')
                <li class="{{ request()->segment(2) === 'rekapitulasi' ? 'active' : '' }}"">
                            <a href=" {{url('admin/rekapitulasi')}}" class="link">
                    <i class="ti-home"></i>
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
                        <i class="ti-pin"></i>
                        <span>Data Anak Banyuwangi</span>
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
                <li class="{{ request()->segment(2) === 'kelola_posyandu' ? 'active' : '' }}">
                    <a href="{{route('kelola_posyandu.index')}}" class="link">
                        <i class="ti-location-pin"></i>
                        <span>Kelola Posyandu</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) === 'kelola_bidan' ? 'active' : '' }}">
                    <a href="{{route('kelola_bidan.index')}}" class="link">
                        <i class="ti-pin2"></i>
                        <span>Kelola Bidan</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) === 'kelola_kader' ? 'active' : '' }}">
                    <a href="{{route('kelola_kader.index')}}" class="link">
                        <i class="ti-pin-alt"></i>
                        <span>Kelola Kader</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) === 'kelola_tips_kesehatan' ? 'active' : '' }}">
                    <a href="#" class="link">
                        <i class="ti-support"></i>
                        <span>Kelola Tips Kesehatan</span>
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
                        <span>Kelola Profil Orangtua dan Anak</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) === 'riwayat_pertumbuhan_anak' ? 'active' : '' }}">
                    <a href="{{url('petugas_desa/riwayat_pertumbuhan_anak/index')}}" class="link">
                        <i class="ti-stats-up"></i>
                        <span>Riwayat Pertumbuhan Anak</span>
                    </a>
                </li>
                <li class="{{ request()->segment(2) === 'laporan_posyandu' ? 'active' : '' }}">
                    <a href="#" class="link">
                        <i class="ti-files"></i>
                        <span>Laporan Posyandu</span>
                    </a>
                </li>
                
            @endif
        </ul>
    </div>
</nav>