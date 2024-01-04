<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Premad Software solution</title>
    <link rel="apple-touch-icon" href="{{ asset('public/admin/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/admin/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/charts/apexcharts.css')}}">
    
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/themes/dark-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/themes/semi-dark-layout.css')}}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/pages/dashboard-ecommerce.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/plugins/charts/chart-apex.css')}}">


    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/forms/select/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/components.css')}}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/plugins/forms/pickers/form-flat-pickr.css')}}">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/css/style.css')}}">
    <!-- END: Custom CSS-->
    <link rel="stylesheet" href="{{ asset('public/sweet-alert/sweet.min.css') }}">
    <style>
        .card-datatable{
            padding: 9px;
        }
        tr{
            border-bottom: 1px solid rgb(105 94 94 / 20%) !important;
        }
        table.dataTable tbody tr.even {
            /* background-color: #f3f2f7; */
        }

        .table > :not(caption) > * > * {
            padding: 0.72rem 1rem;
            background-color: var(--bs-table-bg);
            border-bottom-width: 1px;
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }

        .task-timer-button{
            display: inline-block !important;position: fixed;
            bottom: 2%;
            right: 30px;
            z-index: 99;
        }

        .task-timer-button .ficon{
            height: 2rem !important;
            width: 2rem !important;
        }


    table {
        width: 100%
    }
    table th{
        padding: 0.5rem
    }

    </style>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    @include('employee.layouts.header')

    @include('employee.layouts.sidebar')

    @yield('content')

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        {{-- <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2021<a class="ms-25" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p> --}}
    </footer>


    

    <div class="btn-icon task-timer-button">
        <a class=" " href="#" data-bs-toggle="offcanvas" data-bs-target="#task_timer_detail" aria-controls="offcanvasBottom">
            <i class="ficon" data-feather="clock"></i>
            <span class="badge rounded-pill bg-dark badge-up cart-item-count task_timer">0</span>
        </a>
    </div>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="task_timer_detail" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasBottomLabel" class="offcanvas-title punch_time">Dome</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h5>Test Data</h5>
            <p>
                Lorem ipsum, or lipsum as it is sometimes known, is dummy text used in laying out print, graphic or
                web designs. The passage is attributed to an unknown typesetter in the 15th century who is thought
                to have scrambled parts of Cicero's De Finibus Bonorum et Malorum for use in a type specimen book.
            </p>
            <button type="button" class="btn btn-primary me-1">Continue</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
    </div>
    
    
    <!-- END: Footer-->

    @include('employee.layouts.js')

</body>
<!-- END: Body-->

</html>