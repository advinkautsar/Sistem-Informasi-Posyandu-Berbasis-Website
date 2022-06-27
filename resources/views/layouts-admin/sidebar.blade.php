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
                    <li>
                        <a href="{{url('admin/dashboard')}}" class="link {{ Request::segment(1) === 'super_admin' ? 'active' : null }}">
                            <i class="ti-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
        
                    <li class="active open">
                        <a href="{{url('admin/rekapitulasi')}}" class="link">
                            <i class="ti-write"></i>
                            <span>Rekapitulasi</span>
                        </a>
                       
                    </li>
                    
                </ul>
            </div>
        </nav>        