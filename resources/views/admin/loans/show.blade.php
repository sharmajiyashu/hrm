


@extends('admin.layouts.app')

@section('content')

<style>
    .title_loan{
        text-align: center;
        padding: 1%;
        background-color: #65c06d;
        color: white;
        font-size: 19px;
    }
    .title_loan_2{
        text-align: center;
        padding: 1%;
        background-color: #656dc0;
        color: white;
        font-size: 19px;
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
                        <h2 class="content-header-title float-start mb-0"> Loan Emi </h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                
                                <li class="breadcrumb-item"><a href="{{ route('admin.loans.index') }}">Loans</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">Loan ID : {{ $loan->loan_id }}</a>
                                </li>
                                <li class="breadcrumb-item active">Emi detail
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="content-body">
            <!-- Ajax Sourced Server-side -->
            <section id="ajax-datatable">
                <div class="row">

                    <div class="col-md-6">
                        <div class="card">
                            <div class="title_loan">Loan Detail</div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <ul style="list-style: none;">
                                            <li><h6>Loan ID  </h6></li>
                                            <li><h6>Loan Amount  </h6></li>
                                            <li><h6>Tenure  </h6></li>
                                            <li><h6>Emi  </h6></li>
                                            <li><h6>Rate of Interest  </h6></li>
                                            <li><h6>Interest Amount  </h6></li>
                                            <li><h6>Total Amount Paid  </h6></li>
                                            <li><h6>Start Month  </h6></li>
                                            <li><h6>End Month </h6></li>

                                            
                                        </ul>
                                    </div>
                                    <div class="col-md-7">
                                        
                                        <ul style="list-style: none;">
                                            <li><h6>: {{ $loan->loan_id }}</h6></li>
                                            <li><h6>: {{ $loan->loan_amount }}</h6></li>
                                            <li><h6>: {{ $loan->tenure }}</h6></li>
                                            <li><h6>: {{ $loan->emi }}</h6></li>
                                            <li><h6>: {{ $loan->rate_of_interest }}%</h6></li>
                                            <li><h6>: {{ $loan->interest_amount }}</h6></li>
                                            <li><h6>: {{ $loan->total_amount_paid }}</h6></li>
                                            <li><h6>: {{ $loan->start_month }}</h6></li>
                                            <li><h6>: {{ $loan->end_month }}</h6></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
        
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="title_loan_2">Personal Detail</div>
                            
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <ul style="list-style: none;">
                                            <li><h6>First Name</h6></li>
                                            <li><h6>Last Name  </h6></li>
                                            <li><h6>Email</h6></li>
                                            <li><h6>Mobile</h6></li>
                                            <li><h6>Gender  </h6></li>
                                            <li><h6>Designation  </h6></li>
                                            <li><h6>Date of Birth  </h6></li>
                                            <li><h6>City  </h6></li>
                                            <li><h6>State  </h6></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-7">
                                        
                                        <ul style="list-style: none;">
                                            <li><h6>: {{ $employee->first_name }}</h6></li>
                                            <li><h6>: {{ $employee->last_name }}</h6></li>
                                            <li><h6>: {{ $employee->email }}</h6></li>
                                            <li><h6>: {{ $employee->mobile }}</h6></li>
                                            <li><h6>: {{ $employee->gender }}</h6></li>
                                            <li><h6>: {{ $employee->designation }}</h6></li>
                                            <li><h6>: {{ $employee->date_of_birth }}</h6></li>
                                            <li><h6>: {{ $employee->city }}</h6></li>
                                            <li><h6>: {{ $employee->state }}</h6></li>
                                            
                                            
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="card card-company-table">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" >Emi No.</th>
                                            <th scope="col" >Emi Amount</th>
                                            <th scope="col" >Interest</th>
                                            <th scope="col" >Principal</th>
                                            <th scope="col" >Month</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($emis as $item)
                                            <tr>
                                                <td>{{ $item->emi_number }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                    <div class="avatar bg-light-primary me-1">
                                                        <div class="avatar-content">
                                                            ₹
                                                        </div>
                                                    </div>
                                                    <span class="text-bold"> 
                                                        <strong>{{ $item->emi }}</strong>
                                                   </span>
                                                  </div>
                                                </td>
                                                <td>{{ $item->interest }}%</td>
                                                <td>{{ $item->principal }}</td>
                                                <td>{{ date('M-Y',strtotime($item->emi_date)) }}</td>
                                                <td><span class="badge rounded-pill badge-light-danger">Due</span></td>
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                   

                </div>
            </section>

           

           

        </div>
    </div>
</div>
<!-- END: Content-->
<!-- END: Content-->







@endsection