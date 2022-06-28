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

                    <li class="{{ request()->is('admin/grafik_anak') ? 'active' : '' }}">
                        <a href="{{url('admin/grafik_anak')}}" class="link">
                            <i class="ti-write"></i>
                            <span>Grafik</span>
                        </a>
                       
                    </li>
                    
                </ul>
            </div>
        </nav>        