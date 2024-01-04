
@extends('employee.layouts.app')

@section('content')

<style>
    .Active{
        color: green;
        font-weight: 900;
    }
    .Inactive{
        color: red;
        font-weight: 900;
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
                            <h2 class="content-header-title float-start mb-0">Task Sheet</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{  route('employee.dashboard') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('employee.tasks.index') }}">Task Sheet</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-3" style="text-align: end">
                    <a href="{{ route('employee.tasks.create') }}" class=" btn btn-primary btn-gradient round  ">Create</a>
                </div> --}}
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


                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">

                    <div class="row" >
                        <div class="col-12">
                            <div class="card ">
                                
                                <div class="card-body">

                                        <div class="row">

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Date<span class="error"></span></label>
                                                    <input type="date" id="select_date" name="name" class="form-control" placeholder="Task Name"   value="{{ old('name') }}"/>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Status<span class="error"></span></label>
                                                    <select name="status[]" id="select_status" class="select2 form-select" multiple>
                                                        <option value="0">Pending</option>
                                                        <option value="2">In-Processing</option>
                                                        <option value="3">On-Hold</option>
                                                        <option value="4">For-Review</option>
                                                        <option value="1">Complete</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">QA Status<span class="error"></span></label>
                                                    <select name="qa_status" id="select_qa_status" class="select2 form-select" multiple  aria-placeholder="Select ">
                                                        <option value="0">Pending</option>
                                                        <option value="1">Complete</option>
                                                        <option value="2">Re-Opened</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Project<span class="error"></span></label>
                                                    <select name="name[]" id="select_product" class="select2 form-select" multiple>
                                                        @foreach ($projects as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-3" >
                                                <label for="">Search</label>
                                                <input type="text" id="searchInput" class="form-control" placeholder="Search">
                                            </div>


                                        </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    
                     <!-- Responsive tables start -->
                    <div class="row" >
                        <div class="col-12">
                            <div class="card card-company-table">
                                {{-- <div class="card-header">
                                    <h2></h2>
                                    <div class="col-md-3" style="text-align: end">
                                        <input type="text" id="searchInput" class="form-control" placeholder="Search">
                                    </div>
                                </div> --}}
                                <div class="table-responsive" id="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col" >#</th>
                                                <th scope="col" >Name</th>
                                                <th scope="col" >Description</th>
                                                <th scope="col" >Project</th>
                                                <th scope="col" >Date</th>
                                                <th scope="col" >Expected Time</th>
                                                <th>Working Time</th>
                                                <th scope="col" >Status</th>
                                                <th scope="col" >QA Status</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i = ($tasks->currentPage() - 1) * $tasks->perPage() + 1; @endphp
                                            @foreach ($tasks as $item)
                                                <tr>
                                                    <td >{{ $i }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="{{ asset('public/admin/app-assets/images/icons/toolbox.svg')}}" alt="Toolbar svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder"><a href="{{ route('employee.tasks.show',$item->id) }}">{{ $item->name }}</a></div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td >
                                                        {!! substr(strip_tags($item->description), 0, 30) !!}
                                                    </td>
                                                    <td>
                                                        <span><strong>{{ $item->project_name }}</strong></span>
                                                    </td>
                                                    <td >{{ $item->date }}</td>
                                                    <td >{{ $item->expected_time }}</td>
                                                    <td >
                                                        @if ($item->status == 2)
                                                        <span id="task_time_index_view_{{ $item->id }}" class="text-success">{{ $item->task_time }}</span>
                                                            <script>
                                                                startTaskTimer({{$item->task_time_second }});
                                                                function startTaskTimer(second) {
                                                                    let taskSeconds = second;
                                                                    // Update the timer every second
                                                                    timerIntervalTaskTimer = setInterval(function () {
                                                                        const hours = Math.floor(taskSeconds / 3600);
                                                                        const minutes = Math.floor((taskSeconds % 3600) / 60);
                                                                        const remainingtaskSeconds = taskSeconds % 60;

                                                                        // Display the timer in the specified format
                                                                        const displayText = `${hours}:${minutes < 10 ? '0' : ''}${minutes}:${remainingtaskSeconds < 10 ? '0' : ''}${remainingtaskSeconds}`;

                                                                        // const timerElements = document.querySelectorAll('.task_timer_in_show');

                                                                        document.getElementById("task_time_index_view_{{ $item->id }}").textContent = displayText;
                                                                        // Increment the time
                                                                        taskSeconds++;
                                                                    }, 1000);
                                                                }
                                                            </script>
                                                        @else
                                                            <span class="text-primary">{{ $item->task_time }}</span>
                                                        @endif
                                                    
                                                    </td>
                                                    <td>
                                                        @if ($item->status == 0)
                                                            <span class="badge rounded-pill badge-light-primary">Pending</span>
                                                        @elseif ($item->status == 2)
                                                            <span class="badge rounded-pill badge-light-dark">In Processing</span>
                                                        @elseif ($item->status == 1)
                                                            <span class="badge rounded-pill badge-light-success">Complete</span>
                                                        @elseif ($item->status == 3)
                                                            <span class="badge rounded-pill badge-light-danger">On-Hold</span>
                                                        @elseif ($item->status == 4)
                                                            <span class="badge rounded-pill badge-light-warning">For-Review</span>
                                                        @else
                                                            
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->qa_status == 0)
                                                            <span class="badge rounded-pill badge-light-primary">Pending</span>
                                                        @elseif ($item->qa_status == 2)
                                                            <span class="badge rounded-pill badge-light-dark">In Processing</span>
                                                        @elseif ($item->qa_status == 1)
                                                            <span class="badge rounded-pill badge-light-success">Complete</span>
                                                        @elseif ($item->qa_status == 3)
                                                            <span class="badge rounded-pill badge-light-danger">On-Hold</span>
                                                        @else
                                                            
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                    @include('employee._pagination', ['data' => $tasks])
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#searchInput').on('input', function () {
            fetch_data($(this).val());
        });

        $('#select_date, #select_product ,#select_status , #select_qa_status').on('input', function () {
            let search = document.getElementById("searchInput").value;
            fetch_data(search);
        });


        function fetch_data(query = '') {

            var select_products = [];
            var selectedProducts = $('#select_product').find(':selected').map(function () {
                select_products.push(this.value);
            }).get();
            select_products = JSON.stringify(select_products);

            var select_task_status = [];
            var selectedtask_status = $('#select_status').find(':selected').map(function () {
                select_task_status.push(this.value);
            }).get();
            select_task_status = JSON.stringify(select_task_status);

            var select_task_qa_status = [];
            var selectedtask_status = $('#select_qa_status').find(':selected').map(function () {
                select_task_qa_status.push(this.value);
            }).get();
            select_task_qa_status = JSON.stringify(select_task_qa_status);



            var date = document.getElementById("select_date").value;
            
            $.ajax({
                url: "{{ route('employee.tasks.index') }}",
                method: 'GET',
                data: {search: query,product:select_products , date:date ,status:select_task_status,qa_status:select_task_qa_status},
                dataType: 'html',
                success: function (data) {
                    $('#table-responsive').html(data);
                }
            });
        }
    });
</script>

@endsection