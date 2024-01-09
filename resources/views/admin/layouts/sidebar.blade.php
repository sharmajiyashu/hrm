


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    
                <img src="{{ asset('public/logo_new_white.png') }}" alt="" width="100%">
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                 
            </li>
            
            <li class=" nav-item {{ Request::routeIs('admin.employees.index','admin.employees.create','admin.employees.show','admin.employees.edit','admin.employees.appraisals','admin.employees.loans','admin.employees.salaries') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="user"></i><span class="menu-title text-truncate" data-i18n="Invoice">Employee</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.employees.index','admin.employees.show','admin.employees.edit','admin.employees.appraisals','admin.employees.loans','admin.employees.salaries') ? 'active' : '' }} " href="{{ route('admin.employees.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.employees.create') ? 'active' : '' }} " href="{{ route('admin.employees.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.clients.index','admin.clients.create','admin.clients.edit','admin.clients.show','admin.clients.appraisals','admin.clients.loans','admin.clients.salaries') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Client</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.clients.index','admin.clients.edit','admin.clients.show','admin.clients.appraisals','admin.clients.loans','admin.clients.salaries') ? 'active' : '' }} " href="{{ route('admin.clients.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.clients.create') ? 'active' : '' }} " href="{{ route('admin.clients.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.projects.index','admin.projects.create','admin.projects.show','admin.projects.appraisals','admin.projects.loans','admin.projects.salaries') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="database"></i><span class="menu-title text-truncate" data-i18n="Invoice">Project</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.projects.index','admin.projects.show','admin.projects.appraisals','admin.projects.loans','admin.projects.salaries') ? 'active' : '' }} " href="{{ route('admin.projects.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.projects.create') ? 'active' : '' }} " href="{{ route('admin.projects.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.tasks.index','admin.tasks.create','admin.tasks.show','admin.tasks.appraisals','admin.tasks.loans','admin.tasks.salaries') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="database"></i><span class="menu-title text-truncate" data-i18n="Invoice">Tasks</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.tasks.index','admin.tasks.show','admin.tasks.appraisals','admin.tasks.loans','admin.tasks.salaries') ? 'active' : '' }} " href="{{ route('admin.tasks.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.tasks.create') ? 'active' : '' }} " href="{{ route('admin.tasks.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.loans.index','admin.loans.create','admin.loans.show','admin.loans.appraisals','') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Invoice">Loan</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.loans.index','admin.loans.show','admin.loans.appraisals') ? 'active' : '' }} " href="{{ route('admin.loans.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.loans.create') ? 'active' : '' }} " href="{{ route('admin.loans.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.invoices.index','admin.invoices.create','admin.invoices.show','admin.invoices.appraisals','') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Invoice</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.invoices.index','admin.invoices.show','admin.invoices.appraisals') ? 'active' : '' }} " href="{{ route('admin.invoices.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.invoices.create') ? 'active' : '' }} " href="{{ route('admin.invoices.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.leaves.index','admin.leaves.create','admin.leaves.show','admin.leaves.appraisals','') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Invoice">Leave</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.leaves.index','admin.leaves.show','admin.leaves.appraisals') ? 'active' : '' }} " href="{{ route('admin.leaves.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.leaves.create') ? 'active' : '' }} " href="{{ route('admin.leaves.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.time_sheet') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.time_sheet') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Time Sheet</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                 
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.settings.change_password') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Invoice">Setting </span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.settings.change_password') ? 'active' : '' }} " href="{{ route('admin.settings.change_password') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Change Password</span></a>
                    </li>
                    
                </ul>
            </li>

            

           
        
        </ul>
    </div>
</div>
<!-- END: Main Menu-->