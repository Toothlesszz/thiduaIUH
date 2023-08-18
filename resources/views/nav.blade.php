<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #151335;" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/user') }}">
        <div class="sidebar-brand-text mx-3">
              @if(Auth::user()->level === 1)
                  {{ 'Sinh Viên' }}
              @elseif(Auth::user()->level === 2)
                  {{ 'Giảng Viên' }}
              @else
                  {{ 'Quản lý đoàn khoa' }}
              @endif
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::is('home') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Trang chủ</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ Route::is('listCompete') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('listCompete') }}">
            <i class="fas fa-bell"></i>
            <span>Thi đua, xét duyệt</span>
        </a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item {{ Route::is('register-stylized.index') || Route::is('send-stylized.index') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-star"></i>
            <span>Danh hiệu</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('register-stylized.index') }}">Đăng ký danh hiệu</a>
                <a class="collapse-item" href="{{ route('send-stylized.index') }}">Danh hiệu đã đăng ký</a>
            </div>
        </div>
    </li>

    <li class="nav-item {{ Route::is('passRegister') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('passRegister') }}">
            <i class="fa-solid fa-medal"></i>
            <span>Danh hiệu đã đạt</span>
        </a>
    </li>
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
