<ul class="nav nav-pills mb-2">
    <!-- account -->
    <li class="nav-item">
        <a class="nav-link {{ Request::routeIs('admin.clients.show') ? 'active' : '' }} " href="{{ route('admin.clients.show',$client->id) }}">
            <i data-feather="user" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Account</span>
        </a>
    </li>
    <!-- security -->
    <li class="nav-item">
        <a class="nav-link" href="page-account-settings-security.html">
            <i data-feather="lock" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Project</span>
        </a>
    </li>
    <!-- billing and plans -->
    <li class="nav-item">
        <a class="nav-link" href="page-account-settings-billing.html">
            <i data-feather="bookmark" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Task</span>
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
        <a class="nav-link {{ Request::routeIs('admin.clients.invoices') ? 'active' : '' }}" href="{{ route('admin.clients.invoices',$client->id) }}">
            <i data-feather="link" class="font-medium-3 me-50"></i>
            <span class="fw-bold">Invoice</span>
        </a>
    </li>
    
</ul>