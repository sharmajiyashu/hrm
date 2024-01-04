
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

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
       


        <div class="content-body">
            <div id="user-profile">

                <!-- profile info section -->
                
                    <div class="row">
                        
                        <div class="col-lg-3 col-12 order-2 order-lg-1">
                            
                            <h2>Pending</h2><!-- about -->

                            @foreach ($pending_tasks as $item)

                            @if ($item->status == 0)
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">Task : {{ $item->name }}</h5>
                                        
                                        <div class="">Date : {{ date('d-M-y',strtotime($item->date)) }}</div>
                                        <div class="">Expected Time : {{ $item->expected_time }}</div>
                                        <div class="">Working Time : {{ $item->expected_time }}</div>

                                        <p>
                                            <h6>Description</h6>
                                            {!! substr(strip_tags($item->description), 0, 100) !!}
                                        </p>

                                        <div>
                                            @if ($item->status == 0)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class="btn btn-dark">Start</a>
                                            @elseif ($item->status == 2)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $item->name }}?')" class="btn btn-danger">On Hold</a>
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class="btn btn-success">For-Review</a>
                                            @elseif ($item->status == 3)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class="btn btn-dark">Start</a>
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class="btn btn-success">For-Review</a>
                                            @else
                                                
                                            @endif
                                        </div>
                                        
                                        {{-- <div class="mt-2">
                                            <h5 class="mb-50">Website:</h5>
                                            <p class="card-text mb-0">www.pixinvent.com</p>
                                        </div> --}}
                                    </div>
                                </div>    
                            @endif

                           
                            @endforeach
                           
                        </div>

                        <div class="col-lg-3 col-12 order-2 order-lg-1">
                            
                            <h2>On-Hold</h2><!-- about -->

                            @foreach ($pending_tasks as $item)

                                @if ($item->status == 3)
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="mb-75">Task : {{ $item->name }}</h5>
                                            
                                            <div class="">Date : {{ date('d-M-y',strtotime($item->date)) }}</div>
                                            <div class="">Expected Time : {{ $item->expected_time }}</div>
                                            <div class="">Working Time : {{ $item->expected_time }}</div>

                                            <p>
                                                <h6>Description</h6>
                                                {!! substr(strip_tags($item->description), 0, 100) !!}
                                            </p>

                                            {{-- <div style="   box-sizing: ;"> --}}
                                                @if ($item->status == 0)
                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class="btn btn-dark">Start</a>
                                                @elseif ($item->status == 2)
                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $item->name }}?')" class="btn btn-danger">On Hold</a>
                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class="btn btn-success">For-Review</a>
                                                @elseif ($item->status == 3)
                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class="btn btn-dark">Start</a>
                                                    {{-- <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class="btn btn-success">For-Review</a> --}}
                                                @else
                                                    
                                                @endif
                                            {{-- </div> --}}
                                            
                                            {{-- <div class="mt-2">
                                                <h5 class="mb-50">Website:</h5>
                                                <p class="card-text mb-0">www.pixinvent.com</p>
                                            </div> --}}
                                        </div>
                                    </div>    
                                @endif

                           
                            @endforeach
                           
                        </div>

                        <div class="col-lg-3 col-12 order-2 order-lg-1">
                            
                            <h2>In-Process</h2><!-- about -->

                            @foreach ($pending_tasks as $item)

                            @if ($item->status == 2)
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">Task : {{ $item->name }}</h5>
                                        
                                        <div class="">Date : {{ date('d-M-y',strtotime($item->date)) }}</div>
                                        <div class="">Expected Time : {{ $item->expected_time }}</div>
                                        <div class="">Working Time : {{ $item->expected_time }}</div>

                                        <p>
                                            <h6>Description</h6>
                                            {!! substr(strip_tags($item->description), 0, 100) !!}
                                        </p>

                                        {{-- <div style="   box-sizing: ;"> --}}
                                            @if ($item->status == 0)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class="btn btn-dark">Start</a>
                                            @elseif ($item->status == 2)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $item->name }}?')" class="btn btn-danger">On Hold</a>
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class="btn btn-success">For-Review</a>
                                            @elseif ($item->status == 3)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class="btn btn-dark">Start</a>
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class="btn btn-success">For-Review</a>
                                            @else
                                                
                                            @endif
                                        {{-- </div> --}}
                                        
                                        {{-- <div class="mt-2">
                                            <h5 class="mb-50">Website:</h5>
                                            <p class="card-text mb-0">www.pixinvent.com</p>
                                        </div> --}}
                                    </div>
                                </div>    
                            @endif

                           
                            @endforeach
                           
                        </div>

                        <div class="col-lg-3 col-12 order-2 order-lg-1">
                            
                            <h2>For-Review</h2><!-- about -->

                            @foreach ($pending_tasks as $item)

                            @if ($item->status == 4)
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="mb-75">Task : {{ $item->name }}</h5>
                                        
                                        <div class="">Date : {{ date('d-M-y',strtotime($item->date)) }}</div>
                                        <div class="">Expected Time : {{ $item->expected_time }}</div>
                                        <div class="">Working Time : {{ $item->expected_time }}</div>

                                        <p>
                                            <h6>Description</h6>
                                            {!! substr(strip_tags($item->description), 0, 100) !!}
                                        </p>

                                        {{-- <div style="   box-sizing: ;"> --}}
                                            @if ($item->status == 0)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class="btn btn-dark">Start</a>
                                            @elseif ($item->status == 2)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $item->name }}?')" class="btn btn-danger">On Hold</a>
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class="btn btn-success">For-review</a>
                                            @elseif ($item->status == 3)
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class="btn btn-dark">Start</a>
                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class="btn btn-success">For-Review</a>
                                            @else
                                                
                                            @endif
                                        {{-- </div> --}}
                                        
                                        {{-- <div class="mt-2">
                                            <h5 class="mb-50">Website:</h5>
                                            <p class="card-text mb-0">www.pixinvent.com</p>
                                        </div> --}}
                                    </div>
                                </div>    
                            @endif

                           
                            @endforeach
                           
                        </div>


                       
                       


                    </div>
           
             </div>
         
        </div>
    </div>
</div>

@endsection