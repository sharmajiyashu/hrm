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
    <title>Invoice Print - Vuexy - Bootstrap HTML admin template</title>
    <link rel="apple-touch-icon" href="{{ asset('public/admin/app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/admin/app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/vendors.min.css')}}">
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
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/css/pages/app-invoice-print.css')}}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/assets/css/style.css')}}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="invoice-print p-3">
                    <div class="invoice-header d-flex justify-content-between flex-md-row flex-column pb-2">
                        <div style="width: 60%">
                            <div class="logo-wrapper">
                                <img src="{{ asset('public/'.config('constant.logo')) }}" alt="" width="20%">
                            </div>
                            <p class="card-text mb-25"><strong>{{ config('constant.invoice.company_name') }}</strong></p>
                            <p class="card-text mb-25">{{ config('constant.invoice.company_address') }}</p>
                            <p class="card-text mb-25">{{ config('constant.invoice.company_state_city') }}</p>
                            <p class="card-text mb-25">{{ config('constant.invoice.company_contect') }}</p>
                            <p class="card-text mb-25">{{ config('constant.invoice.company_gst') }}</p>
                            
                        </div>
                        <div class="mt-md-0 mt-2">
                            <h4 class="fw-bold text-end mb-1">INVOICE #3492</h4>
                            <div class="invoice-date-wrapper mb-50">
                                <span class="invoice-date-title">Date Issued:</span>
                                <span class="fw-bold"> {{ date('d M Y',strtotime($invoice->created_at)) }}</span>
                            </div>
                            <div class="invoice-date-wrapper">
                                <span class="invoice-date-title">Due Date:</span>
                                <span class="fw-bold">{{ date('d M Y',strtotime($invoice->due_date)) }}</span>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row pb-2">
                        <div class="col-sm-6">
                            <h6 class="mb-1">Invoice To:</h6>
                            <p class="mb-25">{{ $user->first_name }} {{ $user->last_name }}</p>
                            <p class="mb-25">{{ $client->company_name }}</p>
                            <p class="mb-25">{{ $client->address }}, {{ $client->city }} , {{ $client->state }}</p>
                            <p class="mb-25">{{ $user->mobile }}</p>
                            <p class="mb-0">{{ $user->email }}</p>
                        </div>
                        
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table m-0">
                            <thead>
                                <tr>
                                    <th class="py-1 ps-4">Task description</th>
                                    <th class="py-1">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice_maps as $item)
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text fw-bold mb-25">{{ $item->task }}</p>
                                            <p class="card-text text-nowrap">
                                                {{ $item->description }}
                                            </p>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{ $item->cost }}</span>
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row invoice-sales-total-wrapper mt-3">
                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                            {{-- <p class="card-text mb-0"><span class="fw-bold">Salesperson:</span> <span class="ms-75">Alfie Solomons</span></p> --}}
                        </div>
                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1" style="padding-right: 10%">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Subtotal:</p>
                                    <p class="invoice-total-amount">{{ $invoice->sub_total }}</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Tax Rate:</p>
                                    <p class="invoice-total-amount">{{ $invoice->tax_rate }}</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Tax Amount:</p>
                                    <p class="invoice-total-amount">{{ $invoice->tax }}</p>
                                </div>
                                <hr class="my-50" />
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Total:</p>
                                    <p class="invoice-total-amount">{{ $invoice->total }}</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Paid Amount:</p>
                                    <p class="invoice-total-amount">{{ $invoice->paid_amount }}</p>
                                </div>
                                <hr class="my-50" />
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">Due:</p>
                                    <p class="invoice-total-amount">{{ $invoice->due_amount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-2" />

                    <div class="row">
                        <div class="col-12">
                            <span class="fw-bold">Note:</span>
                            <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                projects. Thank You!</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('public/admin/app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('public/admin/app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ asset('public/admin/app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('public/admin/app-assets/js/scripts/pages/app-invoice-print.js')}}"></script>
    <!-- END: Page JS-->

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>