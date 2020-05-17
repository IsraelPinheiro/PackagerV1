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
        <a class="nav-link pt-0" href="{{ route('inbounds.index') }}">
            <i class="fas fa-fw fa-sign-in-alt"></i>
            <span>Caixa de Entrada</span>
        </a>
    </li>
    <!-- Nav Item - Outbound Box -->
    <li class="nav-item">
        <a class="nav-link pt-0" href="{{ route('outbounds.index') }}">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Caixa de Saída</span>
        </a>
    </li>

    @php
	    $acl_reports_administrative = json_decode(Auth::user()->profile->acl_reports_administrative);
        $acl_reports_operational = json_decode(Auth::user()->profile->acl_reports_operational);
        $acl_dashboards_management = json_decode(Auth::user()->profile->acl_dashboards_management);
        $acl_dashboards_operational = json_decode(Auth::user()->profile->acl_dashboards_operational);
	@endphp
    @if($acl_reports_administrative->read||$acl_reports_operational->read||$acl_dashboards_management->read||$acl_dashboards_operational->read)
        <!-- Divider -->
        <hr class="sidebar-divider">
        <!-- Heading - Management -->
        <div class="sidebar-heading">Gestão</div>
        @if($acl_reports_administrative->read||$acl_reports_operational->read)
            <!-- Nav Item - Reports -->
            <li class="nav-item">
                <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#collapseReports" aria-expanded="true" aria-controls="collapseReports">
                    <i class="fas fa-fw fa-file-contract"></i>
                    <span>Relatórios</span>
                </a>
                <div id="collapseReports" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if($acl_reports_operational->read)
                            <a class="collapse-item" href="{{ route('reports.index',['type' => 'operational']) }}">Operacionais</a> 
                        @endif
                        @if($acl_reports_administrative->read)
                            <a class="collapse-item" href="{{ route('reports.index',['type' => 'administrative']) }}">Administrativos</a>
                        @endif
                    </div>
                </div>
            </li>
        @endif
        @if($acl_dashboards_management->read||$acl_dashboards_operational->read)
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#collapseDashboards" aria-expanded="true" aria-controls="collapseDashboards">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboards</span>
                </a>
                <div id="collapseDashboards" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if($acl_dashboards_management->read)
                            <a class="collapse-item" href="{{ route('dashboards',['type' => 'management']) }}">Gerencial</a>
                        @endif
                        @if($acl_dashboards_operational->read)
                            <a class="collapse-item" href="{{ route('dashboards',['type' => 'operational']) }}">Operacional</a>
                        @endif
                    </div>
                </div>
            </li>
        @endif
        <!-- Divider -->
        <hr class="sidebar-divider">
    @endif

    @php
        $acl_audit_accessLogs = json_decode(Auth::user()->profile->acl_audit_accessLogs);
        $acl_audit_changeLogs = json_decode(Auth::user()->profile->acl_audit_changeLogs);
    @endphp
    @if($acl_audit_accessLogs->read||$acl_audit_changeLogs->read)
        <!-- Heading - Management -->
        <div class="sidebar-heading">Operacional</div>
        <!-- Nav Item - System Audit -->
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#collapseAudit" aria-expanded="true" aria-controls="collapseAudit">
                <i class="fas fa-fw fa-eye"></i>
                <span>Auditoria</span>
            </a>
            <div id="collapseAudit" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @if($acl_audit_accessLogs->read)
                        <a class="collapse-item" href="{{ route('audit.index',['type' => 'access']) }}">Acessos</a>
                    @endif
                    @if($acl_audit_changeLogs->read)
                        <a class="collapse-item" href="{{ route('audit.index',['type' => 'change']) }}">Mudanças</a>
                    @endif
                </div>
            </div>
        </li>
    @endif

    @php
	    $acl_users = json_decode(Auth::user()->profile->acl_users);
        $acl_profiles = json_decode(Auth::user()->profile->acl_profiles);
        $acl_backups = json_decode(Auth::user()->profile->acl_dashboards_management);
        $acl_config = json_decode(Auth::user()->profile->acl_config);
	@endphp
    @if($acl_users->read||$acl_profiles->read||$acl_backups->read||$acl_config->read)
        <!-- Nav Item - System Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed pt-0" href="#" data-toggle="collapse" data-target="#collapseSystem" aria-expanded="true" aria-controls="collapseSystem">
                <i class="fas fa-fw fa-cog"></i>
                <span>Sistema</span>
            </a>
            <div id="collapseSystem" class="collapse" aria-labelledby="headingSystem" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    @if($acl_users->read)
                        <a class="collapse-item" href="{{ route('users.index') }}">Usuários</a>
                    @endif
                    @if($acl_profiles->read)
                        <a class="collapse-item" href="{{ route('profiles.index') }}">Perfis de Usuário</a>
                    @endif
                    @if($acl_backups->read)
                        <a class="collapse-item" href="{{ route('backups.index') }}">Backups</a>
                    @endif
                    @if($acl_config->read)
                        <a class="collapse-item" href="{{ route('config.index') }}">Configurações Gerais</a>
                    @endif
                </div>
            </div>
        </li>
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endif

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>