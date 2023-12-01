


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

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Date  <span class="error">*</span></label>
                                                    <input type="date" name="date" placeholder="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 ">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column"> Due Date  <span class="error">*</span></label>
                                                    <input type="date" name="date" placeholder="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Project  <span class="error">*</span></label>
                                                    <select name="project_id" id="department" class="select2 form-select">
                                                        <option value="">(Select Project)</option>
                                                        @foreach ($projects as  $key => $val)
                                                            <option value="{{ $val->id }}"  {{ (old('project_id') == $val->id) ? 'selected' : '' }} >{{ $val->name }} </option>    
                                                        @endforeach
                                                    </select>
                                                    @error('project_id')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Client  <span class="error">*</span></label>
                                                    <select name="user_id" id="department" class="select2 form-select">
                                                        <option value="">(Select Project)</option>
                                                        @foreach ($clients as  $key => $val)
                                                            <option value="{{ $val->user_id }}" {{ ($user_id == $val->user_id) ? 'selected' : '' }} {{ (old('user_id') == $val->user_id) ? 'selected' : '' }} >{{ $val->first_name }} {{ $val->last_name }} </option>    
                                                        @endforeach
                                                    </select>
                                                    @error('user_id')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            {{-- <div  class=" mb-1"> --}}

                                                <div id="targetDiv" class=" mb-1">

                                                    <div class="col-md-12 row border mb-1" id="append_div_1" >

                                                        <div class="col-md-6 mb-1" >
                                                            <label class="form-label" for="first-name-column">Task Name 1 <span class="error">*</span></label>
                                                            <input type="number" name="quantity_${i}" class="form-control" placeholder="Task Name" required step="any">
                                                        </div>
    
                                                        <div class="col-md-6 mb-1" >
                                                            <label class="form-label" for="first-name-column">Cost <span class="error">*</span></label>
                                                            <input type="number" name="quantity_${i}" class="form-control" placeholder="Cost" required step="any">
                                                        </div>
    
                                                        <div class="col-md-12 mb-1" >
                                                            <label class="form-label" for="first-name-column">Description <span class="error">*</span></label>
                                                            <textarea name="" id="" cols="2" rows="2" class="form-control" placeholder="Enter Description"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                

                                                
                                            {{-- </div> --}}

                                            <div class="col-md-12 col-12 mb-1">
                                                <a href="#" class=" btn-success" style="padding: 3px;" id="addButton" onclick="appendProduct()">+ Add Product</a>
                                                <a href="#" class=" btn-danger" style="padding: 3px;" id="remove_button" onclick="removeProduct()">- Remove</a>
                                            </div>

                                            
                                            <div class="col-md-12 col-12 mb-1">
                                                <label for=""></label>
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
        let i= 1;
        function appendProduct(){
            i++;
            var contentToAppend = `
                <div class="col-md-12 row border mb-1" id="append_div_${i}">

                    <div class="col-md-6 mb-1" >
                        <label class="form-label" for="first-name-column">Task Name ${i} <span class="error">*</span></label>
                        <input type="number" name="quantity_${i}" class="form-control" placeholder="Task Name" required step="any">
                    </div>

                    <div class="col-md-6 mb-1" >
                        <label class="form-label" for="first-name-column">Cost <span class="error">*</span></label>
                        <input type="number" name="quantity_${i}" class="form-control" placeholder="Cost" required step="any">
                    </div>

                    <div class="col-md-12 mb-1" >
                        <label class="form-label" for="first-name-column">Description <span class="error">*</span></label>
                        <textarea name="" id="" cols="2" rows="2" class="form-control" placeholder="Enter Description"></textarea>
                    </div>

                </div>
                `;
                $("#targetDiv").append(contentToAppend);
        }

        function removeProduct(){
            
            var elementToHide = document.getElementById("remove_button");
            if(i == 1){
                elementToHide.style.display = "none";
            }else{
                var divToRemove = document.getElementById("append_div_"+i);
                if (divToRemove) {
                    divToRemove.parentNode.removeChild(divToRemove);
                }
                i --;

                document.getElementById('total_product_input').value = i;

                elementToHide.style.display = "block";
                if(i == 1){
                elementToHide.style.display = "none";
            }
            }
        }
    </script>
    
@endsection