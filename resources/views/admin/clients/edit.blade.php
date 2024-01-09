


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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Clients</a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit
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
                                    <form class="form" action="{{ route('admin.clients.update',$client->id) }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        @method('PATCH')
                                    
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">First Name <span class="error">*</span></label>
                                                    <input type="text" id="first-name-column" name="first_name" class="form-control" placeholder="First Name" oninput=""  value="{{ $client->first_name }}" />
                                                    @error('first_name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Last Name <span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="last_name" class="form-control" placeholder="Last Name" oninput=""  value="{{ $client->last_name }}" />
                                                    @error('last_name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Mobile <span class="error"></span></label>
                                                    <input type="number" id="first-name-column" name="mobile" class="form-control" placeholder="Mobile"  value="{{ $client->mobile }}" />
                                                    @error('mobile')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Email <span class="error"></span></label>
                                                    <input type="email" id="first-name-column" name="email" class="form-control" placeholder="Email"  value="{{ $client->email }}" />
                                                    @error('email')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Gender <span class="error">*</span></label>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <input type="radio"  name="gender" value="male" {{ ($client->gender == 'male') ? 'checked' : '' }}  > <span>Male</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="radio"  name="gender" value="female" {{ ($client->gender == 'female') ? 'checked' : '' }}  > <span>Female</span>
                                                        </div>
                                                    </div>
                                                    @error('gender')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Company Name <span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="company_name" class="form-control" placeholder="Company Name"  value="{{ $client->company_name }}" />
                                                    @error('company_name')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">GST Number<span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="gst_number" class="form-control" placeholder="GST Number"  value="{{ $client->gst_number }}" />
                                                    @error('gst_number')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">State  <span class="error">*</span></label>
                                                    <select name="state" id="department" class="select2 form-select">
                                                        <option value="">(Select state)</option>
                                                        @foreach (config('states') as  $key => $val)
                                                            <option value="{{ $key }}" {{ ($client->state == $key) ? 'selected' : '' }}>{{ $key }}</option>    
                                                        @endforeach
                                                    </select>
                                                    @error('state')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">City<span class="error"></span></label>
                                                    <input type="text" id="first-name-column" name="city" class="form-control" placeholder="City"  value="{{ $client->city }}" />
                                                    @error('city')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Address<span class="error"></span></label>
                                                    <textarea name="address" class="form-control" id="" cols="4" rows="4" placeholder="Address">{{ $client->address }}</textarea>
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