


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
                            <h2 class="content-header-title float-start mb-0">Client</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('employee.tasks.index') }}">projects</a>
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
                                    <form class="form" action="{{ route('employee.tasks.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Task Name<span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="name" class="form-control" placeholder="Task Name" oninput=""  value="{{ old('name') }}" />
                                                    @error('name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                           

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Employee  <span class="error">*</span></label>
                                                    <select name="user_id" id="user_id" class="select2 form-select">
                                                        <option value="">(Select Employee)</option>
                                                        @foreach ($employees as  $key => $val)
                                                            <option value="{{ $val->user_id }}" {{ (old('user_id') == $val->user_id) ? 'selected' : '' }}>{{ $val->first_name }} {{ $val->last_name }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('user_id')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Project  <span class="error">*</span></label>
                                                    <select name="project_id" id="project_id" class="select2 form-select">
                                                        <option value="">(Select Project)</option>
                                                        @foreach ($projects as  $key => $val)
                                                            <option value="{{ $val->id }}" {{ (old('project_id') == $val->user_id) ? 'selected' : '' }}>{{ $val->name }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('project_id')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Date<span class="error">*</span></label>
                                                    <input type="date" id="first-name-column" name="date" class="form-control" placeholder="Start Date" oninput=""  value="{{ old('date') }}" />
                                                    @error('date')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Expected Time<span class="error">*</span></label>
                                                    <div class="form-check-primary form-check-inline">
                                                        <input class="form-check-input"  type="radio" name="expected_time_in"  value="hour" checked  />
                                                        <label class="form-check-label" for="inlineRadio1">Hour</label>
                                                    </div>
                                                    <div class="form-check-success form-check-inline">
                                                        <input class="form-check-input" type="radio"  name="expected_time_in"  value="minute" 
                                                            @if (old('expected_time_in') == 1) checked @endif
                                                        />
                                                        <label class="form-check-label" for="inlineRadio2">Minute</label>
                                                    </div>
                                                    <input type="number" id="first-name-column" name="expected_time" class="form-control" placeholder="Expected Time In Number" oninput=""  value="{{ old('expected_time') }}" />
                                                    @error('expected_time')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Description<span class="error"></span></label>
                                                    <textarea name="description" class="form-control" id="description" cols="4" rows="4" placeholder="Project Description">{{ old('description') }}</textarea>
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

    <script src="https://cdn.ckeditor.com/ckeditor5/35.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .catch(error => {
                console.error(error);
            });
    </script>
    
@endsection