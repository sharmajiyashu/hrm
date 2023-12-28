


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
                            <h4 class="card-title">Total Loan Amount  : {{ $total_loan_amount }}</h4>
                            
                            <a href="{{ route('admin.loans.create',['user_id' => $employee->user_id]) }}" class="btn btn-outline-primary">Create</a>

                        </div>
                        {{-- <div class="card-body py-2 my-25"> --}}
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" >#</th>
                                            <th scope="col" >Loan ID</th>
                                            <th scope="col" >Loan Amount</th>
                                            <th scope="col" >Emi</th>
                                            <th scope="col" >Tenure</th>
                                            <th>Rate of Interest</th>
                                            <th>Emi Start Month</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php  $i = 1; @endphp
                                        @foreach ($loans as $item)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>
                                                    <a href="{{ route('admin.loans.show',$item->id) }}">
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="{{ asset('public/admin/app-assets/images/icons/book.svg')}}" alt="Book svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">{{ $item->loan_id }}</div>
                                                                {{-- <div class="font-small-2 text-muted">pudais@jife.com</div> --}}
                                                            </div>
                                                        </div>
                                                    </a>
                                                    
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                    <div class="avatar bg-light-primary me-1">
                                                        <div class="avatar-content">
                                                            ₹
                                                        </div>
                                                    </div>
                                                    <span class="text-bold"> 
                                                        <strong>{{ $item->loan_amount }}</strong>
                                                   </span>
                                                  </div>
                                                </td>
                                                <td>{{ $item->emi }}</td>
                                                <td>{{ $item->tenure }}</td>
                                                <td>{{ $item->interest_amount }}%</td>
                                                <td>{{ $item->start_month }}</td>
                                                <td>{{ date('d M-Y',strtotime($item->created_at)) }}</td>
                                            </tr>
                                            @php $i++; @endphp
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                                
                            </div>
                        {{-- </div> --}}
                    </div>

                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection