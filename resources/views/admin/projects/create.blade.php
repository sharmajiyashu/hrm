


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
                            <h2 class="content-header-title float-start mb-0">Client</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.projects.index') }}">projects</a>
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
                                    <form class="form" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Project Name<span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="name" class="form-control" placeholder="Project Name" oninput=""  value="{{ old('name') }}" />
                                                    @error('name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Category  <span class="error">*</span></label>
                                                    <select name="category" id="department" class="select2 form-select">
                                                        <option value="">(Select category)</option>
                                                        @foreach (config('constant.project_category') as  $key => $val)
                                                            <option value="{{ $key }}" {{ (old('category') == $key) ? 'selected' : '' }}>{{ $val }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('category')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Client  <span class="error">*</span></label>
                                                    <select name="client" id="client" class="select2 form-select">
                                                        <option value="">(Select category)</option>
                                                        @foreach ($clients as  $key => $val)
                                                            <option value="{{ $val->user_id }}" {{ (old('client') == $val->user_id) ? 'selected' : '' }}>{{ $val->first_name }} {{ $val->last_name }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('client')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Project Lead  <span class="error">*</span></label>
                                                    <select name="manager[]" id="manager[]" class="select2 form-select" multiple>
                                                        <option value="">(Select category)</option>
                                                        @foreach ($employees as  $key => $val)
                                                        <option value="{{ $val->user_id }}" {{ in_array($val->user_id, old('manager', [])) ? 'selected' : '' }}>
                                                            {{ $val->first_name }} {{ $val->last_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('manager')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Team  <span class="error">*</span></label>
                                                    <select name="team[]" id="team[]" class="select2 form-select" multiple>
                                                        <option value="">(Select category)</option>
                                                        @foreach ($employees as  $key => $val)
                                                        <option value="{{ $val->user_id }}" {{ in_array($val->user_id, old('team', [])) ? 'selected' : '' }}>
                                                            {{ $val->first_name }} {{ $val->last_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('team')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Amount<span class="error">*</span></label>
                                                    <input type="number" id="first-name-column" name="amount" class="form-control" placeholder="Amount" oninput=""  value="{{ old('amount') }}" />
                                                    @error('amount')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Start Date<span class="error">*</span></label>
                                                    <input type="date" id="first-name-column" name="start_date" class="form-control" placeholder="Start Date" oninput=""  value="{{ old('start_date') }}" />
                                                    @error('start_date')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">End Date<span class="error">*</span></label>
                                                    <input type="date" id="first-name-column" name="end_date" class="form-control" placeholder="End Date" oninput=""  value="{{ old('end_date') }}" />
                                                    @error('end_date')<span class="error">{{ $message }}</span>@enderror
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