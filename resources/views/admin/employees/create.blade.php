


@extends('layouts.app')

@section('content')

<style>
    .error{
        color:red;
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
                            <h2 class="content-header-title float-start mb-0">Employees</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('employees.index') }}">Employees</a>
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

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">First Name <span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="first_name" class="form-control" placeholder="First Name" oninput=""  value="{{ old('first_name') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Last Name <span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="last_name" class="form-control" placeholder="Last Name" oninput=""  value="{{ old('last_name') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Remark <span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="remark" class="form-control" placeholder="Remak" oninput=""  value="{{ old('remark') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Gender <span class="error">*</span></label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="radio"  name="gender" value="0" {{ (old('gender') == '0') ? 'checked' : '' }} {{ (empty(old('gender')) ? 'checked' : '') }} > <span>Male</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="radio"  name="gender" value="1" {{ (old('gender') == '1') ? 'checked' : '' }}  > <span>Female</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Monthly Salary <span class="error">*</span></label>
                                                    <input type="number" name="monthly_salary" class="form-control" placeholder="Monthly Salary" oninput=""  value="{{ old('monthly_salary') }}" id="monthly_salary" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Per Day Salary  <span class="error">*</span></label>
                                                    <input type="number" name="per_day_salary" readonly class="form-control" placeholder="Per Day Salary" oninput=""  value="{{ old('per_day_salary') }}" id="per_day_salary" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Duty Hours <span class="error">*</span></label>
                                                    <input type="number" name="duty_hour" class="form-control" placeholder="Duty Hour" oninput=""  value="{{ old('duty_hour') }}"  id="duty_hour" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Per Hour Salary <span class="error"></span></label>
                                                    <input type="number" name="per_hour" readonly class="form-control" placeholder="Per Hour" oninput=""  value="{{ old('per_hour') }}" id="per_hour"  />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Date(when salary incresed) <span class="error"></span></label>
                                                    <input type="date" name="salary_increase_date" class="form-control" placeholder="Salary Increase Date" oninput=""  value="{{ old('salary_increase_date') }}" />
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Transportation Cost <span class="error"></span></label>
                                                    <input type="number" id="first-name-column" name="transportation_cost" class="form-control" placeholder="Transportation Cost" oninput=""  value="{{ old('transportation_cost') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Security Deposit <span class="error"></span></label>
                                                    <input type="number" id="first-name-column" name="security_deposit" class="form-control" placeholder="Security Deposit" oninput=""  value="{{ old('security_deposit') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Interest on security deposit <span class="error"></span></label>
                                                    <input type="number" id="first-name-column" name="interest_salary_deposit" class="form-control" placeholder="Interest on security deposit" oninput=""  value="{{ old('interest_salary_deposit') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Old Rate <span class="error"></span></label>
                                                    <input type="number" id="first-name-column" name="old_rate" class="form-control" placeholder="Old Rate" oninput=""  value="{{ old('old_rate') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Old Rate Date <span class="error"></span></label>
                                                    <input type="date" id="first-name-column" name="old_rate_date" class="form-control" placeholder="Old Rate Date" oninput=""  value="{{ old('old_rate_date') }}" />
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
    document.addEventListener('DOMContentLoaded', function() {

        document.getElementById('monthly_salary').addEventListener('change', function() {
            var monthly_salary = parseInt(document.getElementById('monthly_salary').value);
            var per_day_salary = monthly_salary / 26;
            document.getElementById('per_day_salary').value = parseInt(per_day_salary);
        });

        document.getElementById('duty_hour').addEventListener('change', function() {
            var duty_hour = parseInt(document.getElementById('duty_hour').value);
            var monthly_salary = parseInt(document.getElementById('monthly_salary').value);
            var per_day_salary = monthly_salary / 26;
            document.getElementById('per_day_salary').value = parseInt(per_day_salary);
            if (!isNaN(duty_hour)) {
                var per_hour_salary = monthly_salary / 26 / duty_hour;
                document.getElementById('per_hour').value = parseInt(per_hour_salary);
            }
        });

});
     </script>
@endsection