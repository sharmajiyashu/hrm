


@extends('employee.layouts.app')

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
                            <h2 class="content-header-title float-start mb-0">Apply Leave</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('employee.apply_leaves.index') }}">Leaves</a>
                                    </li>
                                    <li class="breadcrumb-item active">Apply
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

           

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('employee.apply_leaves.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Leave Reason <span class="error">*</span></label>
                                                    <select name="type" id="department" class="select2 form-select">
                                                        <option value="">(Select category)</option>
                                                        @foreach (config('constant.leave_reasones') as  $key => $val)
                                                            <option value="{{ $key }}" {{ (old('type') == $key) ? 'selected' : '' }}>{{ $val }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('type')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="fp-multiple">Select Dates</label>
                                                    <input type="text" id="fp-multiple" class="form-control flatpickr-multiple" name="date" placeholder="YYYY-MM-DD" />
                                                    @error('date')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Description<span class="error"></span></label>
                                                    <textarea name="description" class="form-control" id="" cols="4" rows="4" placeholder="Project Description">{{ old('description') }}</textarea>
                                                    @error('description')<span class="error">{{ $message }}</span>@enderror
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