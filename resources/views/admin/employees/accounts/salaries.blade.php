


@extends('admin.layouts.app')

@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Employee</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Employees</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">{{ $employee->first_name }} {{ $employee->last_name }}</a>
                                </li>
                                <li class="breadcrumb-item active"> Account
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    @include('admin.employees.accounts.tab-bar')

                    <!-- profile -->
                    <div class="card card-company-table">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Current Salary  : {{ $employee->salary }}</h4>
                            <a href="#" class="btn btn-outline-primary">Make Advance</a>

                        </div>
                        {{-- <div class="card-body py-2 my-25"> --}}
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" >#</th>
                                            <th scope="col" >Month</th>
                                            <th scope="col" >Salary</th>
                                            <th>Deduction</th>
                                            <th>Total Amount <br> to pay</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php  $i = 1; @endphp
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td><strong>{{ $item['month_name'] }}</strong></td>
                                                <td>₹{{ isset($item['salary']) ? $item['salary'] :'-' }}
                                                    {{-- <i data-feather="trending-down" class="text-danger font-medium-1"></i> --}}
                                                </td>
                                                <td>
                                                    @if ($item['total_deduction'] > 0)
                                                        <a class="avatar bg-light-danger me-1" data-bs-toggle="collapse" href="#collapseExample{{ $i }}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                            <div class="avatar-content">
                                                                    <i data-feather="eye" class="text-danger font-medium-1"></i>
                                                            </div>
                                                        </a>
                                                        <strong>{{ $item['total_deduction'] }}</strong>
                                                        <div class="collapse" id="collapseExample{{ $i }}">
                                                            <div class=" p-1 border">
                                                                <dl class="row">
                                                                    @foreach ($item['deduction'] as $key=>$val)
                                                                        <dt class="col-sm-3">{{ $key }}</dt>
                                                                        <dd class="col-sm-3">{{ $val }}</dd>    
                                                                    @endforeach
                                                                </dl>
                                                            </div>
                                                        </div>  
                                                    @else
                                                    {{-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-container="body" title="Popover on bottom" data-bs-content="kapil  jangid">
                                                        Popover on bottom
                                                    </button> --}}
                                                    
                                                    @endif
                                                    
                                                </td>
                                                <td>₹{{ isset($item['total_amount_tp_pay']) ? $item['total_amount_tp_pay'] :'-' }}</td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                @include('admin._pagination', ['data' => $salaries])
                                
                            </div>
                        {{-- </div> --}}
                    </div>

                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection