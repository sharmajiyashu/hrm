


<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="{{ route('home') }}">
                    
                    <h2 class="brand-text">Premad Software</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}"><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                 
            </li>
            
            <li class=" nav-item {{ Request::routeIs('admin.employees.index','admin.employees.create','admin.employees.show','admin.employees.appraisals') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="Invoice">Employee</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.employees.index','admin.employees.show','admin.employees.appraisals') ? 'active' : '' }} " href="{{ route('admin.employees.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.employees.create') ? 'active' : '' }} " href="{{ route('admin.employees.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs('admin.loans.index','admin.loans.create','admin.loans.show','admin.loans.appraisals') ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href="#"><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="Invoice">Loan</span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.loans.index','admin.loans.show','admin.loans.appraisals') ? 'active' : '' }} " href="{{ route('admin.loans.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.loans.create') ? 'active' : '' }} " href="{{ route('admin.loans.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Create</span></a>
                    </li>
                </ul>
            </li>

            <li class=" nav-item {{ Request::routeIs() ? 'has-sub open' : '' }} "><a class="d-flex align-items-center" href=""><i data-feather="shopping-cart"></i><span class="menu-title text-truncate" data-i18n="Invoice">Setting </span></a>
                <ul class="menu-content">
                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.employee.create') ? 'active' : '' }} " href="{{ route('admin.employees.index') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Employee <br> Management</span></a>
                    </li>

                    <li><a class="d-flex align-items-center {{ Request::routeIs('admin.employee.create') ? 'active' : '' }} " href="{{ route('admin.employees.create') }}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> Staff Attendence</span></a>
                    </li>
                </ul>
            </li>

           
        
        </ul>
    </div>
</div>
<!-- END: Main Menu-->