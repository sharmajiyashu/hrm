


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
            <li class=" nav-item {{ Request::routeIs('employee.dashboard') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('employee.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                 
            </li>
            
            <li class=" nav-item {{ Request::routeIs('employee.apply_leaves.index','employee.apply_leaves.create','employee.apply_leaves.show','employee.apply_leaves.appraisals','employee.apply_leaves.loans','employee.apply_leaves.salaries') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="cloud-off"></i><span class="menu-title text-truncate" data-i18n="Invoice">Leave</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.apply_leaves.index','employee.apply_leaves.show','employee.apply_leaves.appraisals','employee.apply_leaves.loans','employee.apply_leaves.salaries') ? 'active' : '' }} " href="{{ route('employee.apply_leaves.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.apply_leaves.create') ? 'active' : '' }} " href="{{ route('employee.apply_leaves.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Apply</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('employee.attendance') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('employee.attendance') }}"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Attendance</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                 
            </li>
            
            {{-- <li class=" nav-item {{ Request::routeIs('employee.tasks.index') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('employee.tasks.index') }}"><i data-feather="calendar"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Task Sheet</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                 
            </li> --}}

            <li class=" nav-item {{ Request::routeIs('employee.tasks.index','employee.tasks.lists','employee.tasks.testing','employee.tasks.show','employee.tasks.create') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Invoice">Task </span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.tasks.index','employee.tasks.show') ? 'active' : '' }} " href="{{ route('employee.tasks.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Sheet</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.tasks.lists') ? 'active' : '' }} " href="{{ route('employee.tasks.lists') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">List</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.tasks.create') ? 'active' : '' }} " href="{{ route('employee.tasks.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop">Create</span></a>
                    </li>
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.tasks.testing') ? 'active' : '' }} " href="{{ route('employee.tasks.testing',['status' => json_encode([4])]) }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Testing</span><span class="badge badge-light-danger rounded-pill ms-auto me-1">{{ \App\Helpers\Helper::getForReviewTaskCount() }}</span></a>
                    </li>
                </ul>
            </li>


            <li class=" nav-item {{ Request::routeIs('employee.settings.change_password') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Invoice">Setting </span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.settings.change_password') ? 'active' : '' }} " href="{{ route('employee.settings.change_password') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Change Password</span></a>
                    </li>
                    
                </ul>
            </li>

            {{-- <li class=" nav-item {{ Request::routeIs('employee.clients.index','employee.clients.create','employee.clients.show','employee.clients.appraisals','employee.clients.loans','employee.clients.salaries') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Invoice">Client</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.clients.index','employee.clients.show','employee.clients.appraisals','employee.clients.loans','employee.clients.salaries') ? 'active' : '' }} " href="{{ route('employee.clients.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.clients.create') ? 'active' : '' }} " href="{{ route('employee.clients.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('employee.projects.index','employee.projects.create','employee.projects.show','employee.projects.appraisals','employee.projects.loans','employee.projects.salaries') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="database"></i><span class="menu-title text-truncate" data-i18n="Invoice">Project</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.projects.index','employee.projects.show','employee.projects.appraisals','employee.projects.loans','employee.projects.salaries') ? 'active' : '' }} " href="{{ route('employee.projects.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.projects.create') ? 'active' : '' }} " href="{{ route('employee.projects.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('employee.loans.index','employee.loans.create','employee.loans.show','employee.loans.appraisals','') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="package"></i><span class="menu-title text-truncate" data-i18n="Invoice">Loan</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.loans.index','employee.loans.show','employee.loans.appraisals') ? 'active' : '' }} " href="{{ route('employee.loans.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.loans.create') ? 'active' : '' }} " href="{{ route('employee.loans.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('employee.invoices.index','employee.invoices.create','employee.invoices.show','employee.invoices.appraisals','') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="file-text"></i><span class="menu-title text-truncate" data-i18n="Invoice">Invoice</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.invoices.index','employee.invoices.show','employee.invoices.appraisals') ? 'active' : '' }} " href="{{ route('employee.invoices.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.invoices.create') ? 'active' : '' }} " href="{{ route('employee.invoices.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs() ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="settings"></i><span class="menu-title text-truncate" data-i18n="Invoice">Setting </span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.employee.create') ? 'active' : '' }} " href="{{ route('employee.apply_leaves.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Employee <br> Management</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('employee.employee.create') ? 'active' : '' }} " href="{{ route('employee.apply_leaves.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Staff Attendence</span></a>
                    </li>
                </ul>
            </li> --}}

            

           
        
        </ul>
    </div>
</div>
<!-- END: Main Menu-->