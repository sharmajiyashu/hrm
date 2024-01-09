
@extends('admin.layouts.app')

@section('content')

<style>
    .active{
        background-color: #f3f1f1 !important;
    }
</style>

 <!-- BEGIN: Content-->
<!-- BEGIN: Content-->
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-12 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12 text-center" >
                            <h2>Time Sheet</h2>
                            {{-- <h2 class="content-header-title float-start mb-0">Employee</h2> --}}
                            {{-- <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{  route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.leaves.index') }}">leaves</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="text-align: end">
                    {{-- <a href="{{ route('admin.leaves.create') }}" class=" btn btn-primary btn-gradient round  ">Create</a> --}}
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
                <div class="row" >
                    <div class="col-12">
                        <div class="card card-company-table">
                            {{-- <div class="card-header">
                                <h4 class="card-title"></h4>
                                <div class="col-md-3" style="text-align: end">
                                    <input type="text" id="searchInput" class="form-control" placeholder="Search">
                                </div>
                            </div> --}}
                            <div class="table-responsive" id="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" >Employee</th>
                                            @foreach ($current_week_days as $date)
                                                <th class="text-center">{{ date('d-D',strtotime($date)) }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($employees as $employee)
                                            <tr>
                                                <th>{{ $employee->first_name }} {{ $employee->last_name }}</th>
                                                @foreach ($employee->time_sheet as $item)
                                                    <td class="@if($item['date'] == date('Y-m-d')) active @endif">
                                                        <div style="font-size:9px">
                                                            <span class="badge rounded-pill badge-light-dark">
                                                                In : {{ isset($item->punch_in) ? date('H:i',strtotime($item->punch_in)) : '-' }}
                                                            </span>
                                                            <span class="badge rounded-pill badge-light-dark">
                                                                Out : {{ isset($item->punch_out) ? date('H:i',strtotime($item->punch_out)) : '-' }}
                                                            </span>
                                                        </div>

                                                        {{-- <div> --}}
                                                            <h3 class="badge rounded-pill badge-light-success" style="width: 100%">
                                                                WH : {{ isset($item['working_hour']) ? date('H:i',strtotime($item['working_hour'])) : '-' }}
                                                            </h3>
                                                            <h3 class="badge rounded-pill badge-light-danger" style="width: 100%">
                                                                BH : {{ isset($item['break_hour']) ? date('H:i',strtotime($item['break_hour'])) : '-' }}
                                                            </h3>

                                                            <h6 class="text-center" style="width: 100%;font-size:9px" data-bs-toggle="tooltip" data-bs-placement="top" title=" {{ isset($item->device) ? $item->device :'' }} ">
                                                                Ip : {{ isset($item->ip_address) ? $item->ip_address :'' }}
                                                            </h6>

                                                            
                                                        {{-- </div> --}}

                                                        
                                                        
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                            
                            {{-- <div class="table-responsive">
                                <table class="table mb-0">
                                    <!-- ... (your table structure) ... -->
                                </table>
                                {{ $leaves->links('admin._pagination') }}
                            </div> --}}
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            fetch_data($(this).val());
        });

        function fetch_data(query = '') {
            $.ajax({
                url: "{{ route('admin.leaves.index') }}",
                method: 'GET',
                data: {search: query},
                dataType: 'html',
                success: function (data) {
                    $('#table-responsive').html(data);
                }
            });
        }
    });
</script>

@endsection