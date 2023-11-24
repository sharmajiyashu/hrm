


@extends('admin.layouts.app')

@section('content')

<style>
    .error{
        color:#a93c3d !important;
        font-weight: 500;
    }
    /* input {
        text-transform: uppercase;
    } */
</style>

 <!-- BEGIN: Content-->
 <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Loan</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.loans.index') }}">Loans</a>
                                    </li>
                                    <li class="breadcrumb-item active">Create
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

            {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                                            {{$error}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif --}}

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.loans.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" for="username">Loan Amount </label>
                                                <input type="number" name="loan_amount" onkeyup="showEmi()" class="form-control" id="loan_amount" placeholder="Loan Amount" value="{{ old('loan_amount') }}"/>
                                                @error('loan_amount')<span class="error">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" for="username">Rate Of Intrest </label>
                                                <input type="number"  name="rate_of_interest" step="any"  onkeyup="showEmi()" class="form-control" id="interes_rate" placeholder="Rate Of Intrest" value="{{ old('rate_of_interest',0) }}"/>
                                                @error('rate_of_interest')<span class="error">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" for="username">Tenure </label>
                                                <input type="number" name="tenure"  onkeyup="showEmi()" class="form-control" id="tenure" placeholder="Tenure" value="{{ old('tenure') }}"/>
                                                @error('tenure')<span class="error">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" for="username">Emi Amount</label>
                                                <input type="text" readonly name="emi_amount" id="emi_amount"  class="form-control" placeholder="Emi Amount" value="{{ old('emi_amount') }}"/>
                                                @error('emi_amount')<span class="error">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" for="username">Emi Start </label>
                                                <input type="month" id="start_month"  name="emi_start" class="form-control" placeholder="Emi Amount" value="{{ old('emi_start') }}"  onkeyup="getEndMonth()" onchange="getEndMonth()"/>
                                                @error('emi_start')<span class="error">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="col-md-6 mb-1">
                                                <label class="form-label" for="username">Emi End </label>
                                                <input type="month" readonly  name="emi_end" id="end_month" class="form-control" placeholder="Emi Amount" value="{{ old('emi_end') }}"/>
                                                @error('emi_end')<span class="error">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Employee  <span class="error">*</span></label>
                                                    <select name="user_id" id="department" class="select2 form-select">
                                                        <option value="">(Select Employee)</option>
                                                        @foreach ($employees as  $key => $val)
                                                            <option value="{{ $val->user_id }}" {{ (old('user_id') == $val->user_id) ? 'selected' : '' }}>{{ $val->first_name }} {{ $val->last_name }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('user_id')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <script>
        function calculateEMI(loanAmount, annualInterestRate, tenureInMonths) {
            // Check if annualInterestRate is non-zero
            if (annualInterestRate == 0) {
                // Handle the case where the interest rate is 0
                return loanAmount / tenureInMonths;
            }
    
            // Calculate the monthly interest rate
            const monthlyInterestRate = (annualInterestRate / 12) / 100;
    
            // Calculate the total number of monthly payments
            const totalPayments = tenureInMonths;
    
            // Calculate EMI
            const emi = loanAmount * monthlyInterestRate * Math.pow(1 + monthlyInterestRate, totalPayments) / (Math.pow(1 + monthlyInterestRate, totalPayments) - 1);
    
            return emi;
        }
    
        function showEmi(){
            const loanAmount = document.getElementById("loan_amount").value; // Loan amount in dollars
            const annualInterestRate = document.getElementById("interes_rate").value; // Annual interest rate (6.5%)
            const tenureInMonths = document.getElementById("tenure").value; // Loan tenure in months
    
            const emi = calculateEMI(loanAmount, annualInterestRate, tenureInMonths);
            document.getElementById("emi_amount").value = Math.round(emi);
            getEndMonth();
        }

        function getEndMonth(){
            let value = document.getElementById("start_month").value;
            let currentDate = new Date(value);
            let tenureInMonths_2 = parseInt(document.getElementById("tenure").value ,0);
            currentDate.setMonth(currentDate.getMonth() + tenureInMonths_2);
            let year = currentDate.getFullYear();
            let month = (currentDate.getMonth() + 1).toString().padStart(2, '0'); // Adding 1 because months are zero-indexed
            let formattedDate = `${year}-${month}`;
            document.getElementById("end_month").value = formattedDate;
        }
    </script>
    
@endsection