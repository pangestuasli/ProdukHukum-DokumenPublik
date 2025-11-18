<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <a class="nav-link" href="index.html">
        <i class="icon-grid menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="icon-layout menu-icon"></i>
        <span class="menu-title">Data</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item">
        <a class="nav-link" href="{{ route('warga.index') }}">
            <i class="menu-icon mdi mdi-account-multiple"></i>
            Warga
        </a>
        </li>
        </ul>
      </div>
    </li>
      <li class="nav-item">
             <a class="nav-link" href="{{ route('jenis_dokumen.index') }}">Jenis Dokumen</a>
    </li>
  </ul>
</nav>
