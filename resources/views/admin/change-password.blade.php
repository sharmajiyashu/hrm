


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
                            <h2 class="content-header-title float-start mb-0">Change Password</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Settings</a>
                                    </li>
                                    <li class="breadcrumb-item active">Change Password
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
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.settings.update_password') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}

                                        @if(session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <div class="alert-body">
                                                    {{ session('success') }}
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                    
                                        <div class="row">

                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-label" for="reset-password-new">Current Password</label>
                                                </div>
                                                <div class="input-group input-group-merge form-password-toggle">
                                                    <input type="password" class="form-control form-control-merge" id="reset-password-new" name="current_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-new" tabindex="1" autofocus value="{{ old('current_password') }}" />
                                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                </div>
                                                @error('current_password')<span class="error">{{ $message }}</span>@enderror
                                            </div>

                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-label" for="reset-password-new">New Password</label>
                                                </div>
                                                <div class="input-group input-group-merge form-password-toggle">
                                                    <input type="password" class="form-control form-control-merge" id="reset-password-new" name="new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-new" tabindex="1" autofocus value="{{ old('new_password') }}" />
                                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                </div>
                                                @error('new_password')<span class="error">{{ $message }}</span>@enderror
                                            </div>
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-label" for="reset-password-confirm">Confirm Password</label>
                                                </div>
                                                <div class="input-group input-group-merge form-password-toggle">
                                                    <input type="password" class="form-control form-control-merge" id="reset-password-confirm" name="confirm_password" value="{{ old('confirm_password') }}" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="reset-password-confirm" tabindex="2" />
                                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                </div>
                                                @error('confirm_password')<span class="error">{{ $message }}</span>@enderror
                                            </div>
                                            <button class="btn btn-primary w-100" tabindex="3">Set New Password</button>

                                           
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