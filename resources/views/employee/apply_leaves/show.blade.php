@extends('employee.layouts.app')

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
                                <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('employee.apply_leaves.index') }}">leaves</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#"></a>
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
                    <!-- profile -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h3 class="card-title">
                                Leave Type : 
                                {{ config('constant.leave_reasones.'.$applyLeave->type) }}
                            </h3>
                            <h4>
                                Status : 
                                @if ($applyLeave->status == 0)
                                    <span class="badge rounded-pill badge-light-primary">Pending</span>
                                @elseif ($applyLeave->status == 1)
                                    <span class="badge rounded-pill badge-light-success">Approved</span>
                                @elseif ($applyLeave->status == 3)
                                    <span class="badge rounded-pill badge-light-danger">Reject</span>
                                @else
                                    
                                @endif
                            
                            </h4>
                        </div>
                        <div class="card-body " >
                            
                            
                                <div class="row">

                                    <div class="col-12 col-sm-6 mb-1">
                                        {{-- <h4>
                                            Leave Type : 

                                            {{ config('constant.leave_reasones.'.$applyLeave->type) }}
                                        </h4> --}}
                                        
                                    </div>

                                    <div class="col-12 col-sm-6 mb-1">
                                        {{-- <h4>
                                                Status : 
                                            @if ($applyLeave->status == 0)
                                                <span class="badge rounded-pill badge-light-primary">Pending</span>
                                            @elseif ($applyLeave->status == 1)
                                                <span class="badge rounded-pill badge-light-success">Approved</span>
                                            @elseif ($applyLeave->status == 3)
                                                <span class="badge rounded-pill badge-light-danger">Reject</span>
                                            @else
                                                
                                            @endif
                                        </h4> --}}
                                        
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                               <tr>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Type</th>
                                               </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($leave_requests as $item)
                                                <tr>
                                                    <td><div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary me-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="calendar" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span><strong>{{ $item->date }}</strong></span>
                                                    </div></td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            <span class="badge rounded-pill badge-light-primary">Pending</span>
                                                        @elseif ($item->status == 1)
                                                            <span class="badge rounded-pill badge-light-success">Approved</span>
                                                        @elseif ($item->status == 3)
                                                            <span class="badge rounded-pill badge-light-danger">Reject</span>
                                                        @else
                                                            
                                                        @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span id="span_value_{{ $item->id }}">
                                                            @if ($item->type == 1)
                                                                P/L
                                                            
                                                            @elseif ($item->type == 2)
                                                                Half : P/L , Half : C/L
                                                            @elseif ($item->type == 3)
                                                                CL
                                                            @else
                                                                
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>    
                                                <?php $i++;  ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <th>Paid leave</th>
                                                <td><span id="paid_leave_span">0</span></td>
                                            </tr>
                                            <tr>
                                                <th>Casual leave</th>
                                                <td><span id="casual_leave_span">0</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection