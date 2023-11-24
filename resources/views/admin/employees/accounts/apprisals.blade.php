


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
                                <li class="breadcrumb-item"><a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Employees</a>
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
                    <ul class="nav nav-pills mb-2">
                        <!-- account -->
                        <li class="nav-item">
                            <a class="nav-link " href="{{ route('admin.employees.show',$employee->id) }}">
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
                            <a class="nav-link" href="page-account-settings-connections.html">
                                <i data-feather="link" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Salary</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="page-account-settings-connections.html">
                                <i data-feather="link" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Loans</span>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link active" href="{{ route('admin.employees.appraisals',$employee->id) }}">
                                <i data-feather="link" class="font-medium-3 me-50"></i>
                                <span class="fw-bold">Appraisal</span>
                            </a>
                        </li>
                    </ul>

                    <!-- profile -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Current Salary : 5000</h4>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                                Create
                            </button>
                            <!-- Modal -->
                            <div class="modal fade text-start" id="inlineForm" tabindex="-1" aria-labelledby="myModalLabel33" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel33">Appraisal Create</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('admin.employees.apprisal_save') }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <label>Appraisal Date </label>
                                                <div class="mb-1">
                                                    <input type="month" name="date" required placeholder="Email Address" class="form-control" min="{{ date('Y-m') }}" />
                                                </div>

                                                <label>Increased Salary </label>
                                                <div class="mb-1">
                                                    <input type="number"  name="salary" required placeholder="Increased Salary" class="form-control" />
                                                </div>

                                                <label>Next Appraisal Date </label>
                                                <div class="mb-1">
                                                    <input type="month" name="next_date" required placeholder="Email Address" class="form-control" min="{{ date('Y-m') }}"/>
                                                </div>
                                                <input type="hidden" name="user_id" value="{{ $employee->user_id }}">

                                                <label>Remark</label>
                                                <textarea name="remark" class="form-control" id="" cols="3" rows="3" placeholder="Remark"></textarea>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="card-body py-2 my-25"> --}}
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" >#</th>
                                            <th scope="col" >Apprisal Date</th>
                                            <th scope="col" >Salary</th>
                                            <th scope="col" >Next Date</th>
                                            <th>Remark</th>
                                            <th>Created at</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php  $i = 1; @endphp
                                        @foreach ($apprisals as $item)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ date('M-Y',strtotime($item->date)) }}</td>
                                                <td>{{ $item->salary }}</td>
                                                <td>{{ date('M-Y',strtotime($item->next_date)) }}</td>
                                                <td>{{ $item->remark }}</td>
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