<ul class="nav nav-pills mb-2">
    <!-- account -->
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('admin.employees.show') ? 'active' : '' }} " href="{{ route('admin.employees.show',$employee->id) }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Account</span>
        </a>
    </li>
    <!-- security -->
    <li class="nav-item">
        <a class="nav-link" href="page-account-settings-security.html">
            <i data-feather="lock" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Attendance</span>
        </a>
    </li>
    <!-- billing and plans -->
    <li class="nav-item">
        <a class="nav-link" href="page-account-settings-billing.html">
            <i data-feather="bookmark" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Time Sheet</span>
        </a>
    </li>
    <!-- notification -->
    <li class="nav-item">
        <a class="nav-link" href="page-account-settings-notifications.html">
            <i data-feather="bell" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Transaction</span>
        </a>
    </li>
    <!-- connection -->
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('admin.employees.salaries') ? 'active' : '' }}" href="{{ route('admin.employees.salaries',$employee->id) }}">
            <i data-feather="link" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Salary</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link {{ Request::routeIs('admin.employees.loans') ? 'active' : '' }}" href="{{ route('admin.employees.loans',$employee->id) }}">
            <i data-feather="link" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Loan</span>
        </a>
    </li>

    <li class="nav-item ">
        <a class="nav-link   {{ Request::routeIs('admin.employees.appraisals') ? 'active' : '' }}" href="{{ route('admin.employees.appraisals',$employee->id) }}">
            <i data-feather="link" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Appraisal</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="page-account-settings-notifications.html">
            <i data-feather="bell" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Letters</span>
        </a>
    </li>
</ul>