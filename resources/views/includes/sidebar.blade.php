<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-archive"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name', 'Laravel') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Heading - Packages -->
    <div class="sidebar-heading">Pacotes</div>
    <!-- Nav Item - Inbound Box -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-sign-in-alt"></i>
            <span>Caixa de Entrada</span>
        </a>
    </li>
    <!-- Nav Item - Outbound Box -->
    <li class="nav-item">
        <a class="nav-link pt-0" href="index.html">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Caixa de Saída</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Reports -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-file-contract"></i>
            <span>Relatórios</span>
        </a>
    </li>
    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link pt-0" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - System Audit -->
    <li class="nav-item">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-eye"></i>
            <span>Auditoria</span>
        </a>
    </li>

    <!-- Nav Item - System Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#collapseSystem" aria-expanded="true" aria-controls="collapseSystem">
            <i class="fas fa-fw fa-cog"></i>
            <span>Sistema</span>
        </a>
        <div id="collapseSystem" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="buttons.html">Usuários</a>
                <a class="collapse-item" href="cards.html">Perfis de Acesso</a>
                <a class="collapse-item" href="cards.html">Backups</a>
                <a class="collapse-item" href="cards.html">Configurações Gerais</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>