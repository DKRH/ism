
@section('sidebar')
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">MIS Rapat</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('profil') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Profil Kantor DPRD</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('data-anggota-dprd') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Data Anggota DPRD</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('data-perangkat-daerah') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Data Perangkat Desa</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('list-rapat') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Data Rapat</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" target="_blank" href="{{ url('form-hadir') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Buka Form Hadir</span></a>
        </li>
    </ul>
@endsection