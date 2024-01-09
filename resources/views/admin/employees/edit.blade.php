


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
                            <h2 class="content-header-title float-start mb-0">Employee</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Employees</a>
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
                                    <form class="form" action="{{ route('admin.employees.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('PATCH')
                                    
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">First Name <span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="first_name" class="form-control" placeholder="First Name" oninput=""  value="{{ $employee->first_name }}" />
                                                    @error('first_name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Last Name <span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="last_name" class="form-control" placeholder="Last Name" oninput=""  value="{{ $employee->last_name }}" />
                                                    @error('last_name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Mobile <span class="error"></span></label>
                                                    <input type="number" id="first-name-column" name="mobile" class="form-control" placeholder="Mobile"  value="{{ $employee->mobile }}" />
                                                    @error('mobile')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Email <span class="error"></span></label>
                                                    <input type="email" id="first-name-column" name="email" class="form-control" placeholder="Email"  value="{{ $employee->email }}" />
                                                    @error('email')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Gender <span class="error">*</span></label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="radio"  name="gender" value="male" {{ ($employee->gender == 'male') ? 'checked' : '' }}  > <span>Male</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="radio"  name="gender" value="female" {{ ($employee->gender == 'female') ? 'checked' : '' }}  > <span>Female</span>
                                                        </div>
                                                    </div>
                                                    @error('gender')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Date of Birth <span class="error"></span></label>
                                                    <input type="date" id="first-name-column" name="date_of_birth" class="form-control" placeholder="Date of birth"  value="{{ date('Y-m-d',strtotime($employee->date_of_birth)) }}" />
                                                    @error('date_of_birth')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Date of Joining <span class="error"></span></label>
                                                    <input type="date" id="first-name-column" name="date_of_join" class="form-control" placeholder="Date of join"  value="{{ date('Y-m-d',strtotime($employee->date_of_join)) }}" />
                                                    @error('date_of_join')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Designation  <span class="error">*</span></label>
                                                    <select name="designation" id="designation" class="select2 form-select">
                                                        <option value="">(Select designation)</option>
                                                        @foreach (config('constant.designation') as $key => $val)
                                                            <option value="{{ $key }}" {{ ($employee->designation == $val) ? 'selected' : '' }}>{{ $val }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('designation')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Salary<span class="error"></span></label>
                                                    <input type="number" id="first-name-column" name="salary" class="form-control" placeholder="Salary"  value="{{ $employee->salary }}" />
                                                    @error('salary')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Probation end date<span class="error"></span></label>
                                                    <input type="date" id="first-name-column" name="probation_end_date" class="form-control" placeholder="Probation End Date"  value="{{ date('Y-m-d',strtotime($employee->probation_end_date)) }}" />
                                                    @error('probation_end_date')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">State  <span class="error">*</span></label>
                                                    <select name="state" id="department" class="select2 form-select">
                                                        <option value="">(Select state)</option>
                                                        @foreach (config('states') as  $key => $val)
                                                            <option value="{{ $key }}" {{ ($employee->state == $key) ? 'selected' : '' }}>{{ $key }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('state')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">City<span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="city" class="form-control" placeholder="City"  value="{{ $employee->city }}" />
                                                    @error('city')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Address<span class="error"></span></label>
                                                    <textarea name="address" class="form-control" id="" cols="4" rows="4" placeholder="Address">{{ $employee->address }}</textarea>
                                                    @error('address')<span class="error">{{ $message }}</span>@enderror
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
    
@endsection