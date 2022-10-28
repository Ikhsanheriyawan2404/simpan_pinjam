<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Dashboards</li>
            <li>
                <a href="{{ route('home') }}" class="mm-active">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Dashboard
                </a>
            </li>
            <li class="app-sidebar__heading">UI Components</li>
            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-diamond"></i>
                    Manajemen Pengguna
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('users.index') }}">
                            <i class="metismenu-icon"></i>
                            Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('roles.index') }}">
                            <i class="metismenu-icon"></i>
                            Role
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="{{ route('pinjaman.index', []) }}">
                    <i class="metismenu-icon pe-7s-car"></i>
                    Components
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
            </li>
            <li class="app-sidebar__heading">PRO Version</li>
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="metismenu-icon pe-7s-rocket"></i>
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</div>
