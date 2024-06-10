@if (Auth::user()->role == 'admin')
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="/dashboard"> <img alt="image" src="foto/logo.png" class="header-logo" />
                    <span class="logo-name">Poliklinik</span>
                </a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Main</li>
                <li class="dropdown {{ Request::path() === 'dashboard' ? 'active' : '' }}">
                    <a href="/dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                </li>


                </li>
                <li class="menu-header">Pendaftaran</li>
                <li class="dropdown {{ Request::path() === 'pendaftaran-pasien-baru' ? 'active' : '' }}"><a
                        class="nav-link" href="/pendaftaran-pasien-baru"><i
                            data-feather="clipboard"></i><span>Pendaftaran Pasien
                            Baru</span></a>
                </li>
                <li class="dropdown {{ Request::path() === 'pendaftaran-pasien-lama' ? 'active' : '' }}"><a
                        class="nav-link" href="/pendaftaran-pasien-lama"><i
                            data-feather="file-plus"></i><span>Pendaftaran Pasien
                            Lama</span></a>
                </li>
                <li class="menu-header">Perawatan</li>
                <li class="dropdown {{ Request::path() === 'daftar-tunggu' ? 'active' : '' }}"><a class="nav-link"
                        href="/daftar-tunggu"><i data-feather="archive"></i><span>Daftar Tunggu</span></a>
                </li>
                <li class="dropdown {{ Request::path() === 'arsip-admin' ? 'active' : '' }}"><a class="nav-link"
                        href="/arsip-admin"><i data-feather="book-open"></i><span>History Semua Terdaftar</span></a>
                </li>
            </ul>
        </aside>
    </div>
@else
    <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
                <a href="/dashboard"> <img alt="image" src="foto/logo.png" class="header-logo" />
                    <span class="logo-name">Poliklinik</span>
                </a>
            </div>
            <ul class="sidebar-menu">
                <li class="menu-header">Main</li>
                <li class="dropdown {{ Request::path() === 'dashboard' ? 'active' : '' }}">
                    <a href="/dashboard" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
                </li>


                </li>
                <li class="menu-header">Pendaftaran</li>
                <li class="dropdown {{ Request::path() === 'pendaftaran-pasien-baru' ? 'active' : '' }}"><a
                        class="nav-link" href="/pendaftaran-pasien-baru"><i
                            data-feather="clipboard"></i><span>Pendaftaran Pasien
                            Baru</span></a>
                </li>
                <li class="dropdown {{ Request::path() === 'pendaftaran-pasien-lama' ? 'active' : '' }}"><a
                        class="nav-link" href="/pendaftaran-pasien-lama"><i
                            data-feather="file-plus"></i><span>Pendaftaran Pasien
                            Lama</span></a>
                </li>
                <li class="menu-header">Perawatan</li>
                <li class="dropdown {{ Request::path() === 'arsip' ? 'active' : '' }}"><a class="nav-link"
                        href="/arsip"><i data-feather="archive"></i><span>History Perawatan</span></a>
                </li>
            </ul>
        </aside>
    </div>
@endif
