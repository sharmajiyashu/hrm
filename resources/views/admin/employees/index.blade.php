
@extends('admin.layouts.app')

@section('content')

<style>
    .Active{
        color: green;
        font-weight: 900;
    }
    .Inactive{
        color: red;
        font-weight: 900;
    }
</style>

 <!-- BEGIN: Content-->
<!-- BEGIN: Content-->
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Employees</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{  route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Employees</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="text-align: end">
                    <a href="{{ route('admin.employees.create') }}" class=" btn btn-primary btn-gradient round  ">Create</a>
                </div>
            </div>
            <div class="content-body">

                @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                                            {{$error}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif


                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                     <!-- Responsive tables start -->
                <div class="row" id="table-responsive">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Responsive tables</h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="text-nowrap">#</th>
                                            <th scope="col" class="text-nowrap">Heading 1</th>
                                            <th scope="col" class="text-nowrap">Heading 2</th>
                                            <th scope="col" class="text-nowrap">Heading 3</th>
                                            <th scope="col" class="text-nowrap">Heading 4</th>
                                            <th scope="col" class="text-nowrap">Heading 5</th>
                                            <th scope="col" class="text-nowrap">Heading 6</th>
                                            <th scope="col" class="text-nowrap">Heading 7</th>
                                            <th scope="col" class="text-nowrap">Heading 8</th>
                                            <th scope="col" class="text-nowrap">Heading 9</th>
                                            <th scope="col" class="text-nowrap">Heading 10</th>
                                            <th scope="col" class="text-nowrap">Heading 11</th>
                                            <th scope="col" class="text-nowrap">Heading 12</th>
                                            <th scope="col" class="text-nowrap">Heading 13</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-nowrap">1</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                            <td class="text-nowrap">Table cell</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Responsive tables end -->
                </section>

                <!--/ Ajax Sourced Server-side -->

                

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <!-- END: Content-->

    <script>
        
    </script>

@endsection