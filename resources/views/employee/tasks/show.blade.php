@extends('employee.layouts.app')



@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Task Detail</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('employee.tasks.index') }}">Tasks</a>
                                </li>
                                <li class="breadcrumb-item active"> Show
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-12">
                    
                    <!-- profile -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">{{ $task->name }}</h4>
                            @if ($task->status == 0)
                                <span class="badge rounded-pill badge-light-primary">Pending</span>
                            @elseif ($task->status == 2)
                                <span class="badge rounded-pill badge-light-dark">In Processing</span>
                            @elseif ($task->status == 1)
                                <span class="badge rounded-pill badge-light-success">Complete</span>
                            @elseif ($task->status == 3)
                                <span class="badge rounded-pill badge-light-danger">On-Hold</span>
                            @else
                                
                            @endif
                            
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 py-2 my-25 card mb-1" style="border: solid 1px ">
                                    <div class="" >
                                        <h2>Description</h2>
                                        {!! $task->description !!}
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-1" >
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>Task name</th>
                                                    <td>{{ $task->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Expected time</th>
                                                    <td>{{ $task->expected_time }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Working Timer</th>
                                                    <td ><span class="task_timer_in_show">{{ $task->task_time }}</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Date</th>
                                                    <td ><span class="">{{ $task->date }}</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="mb-1" style="    text-align: end;">
                                        @if ($task->status == 0)
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-dark">Start</a>
                                        @elseif ($task->status == 2)
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $task->name }}?')" class="btn btn-danger">On Hold</a>
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $task->name }}?')" class="btn btn-success">For-Review</a>
                                        @elseif ($task->status == 3)
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-dark">Start</a>
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $task->name }}?')" class="btn btn-success">For-Review</a>
                                        @else
                                            
                                        @endif
                                    </div>
                                    
                                </div>


                            </div>
                            

                            
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>





<script>

    function startTaskTimer(second) {
        let taskSeconds = second;
        // Update the timer every second
        timerIntervalTaskTimer = setInterval(function () {
            const hours = Math.floor(taskSeconds / 3600);
            const minutes = Math.floor((taskSeconds % 3600) / 60);
            const remainingtaskSeconds = taskSeconds % 60;

            // Display the timer in the specified format
            const displayText = `${hours}:${minutes < 10 ? '0' : ''}${minutes}:${remainingtaskSeconds < 10 ? '0' : ''}${remainingtaskSeconds}`;

            const timerElements = document.querySelectorAll('.task_timer_in_show');
            timerElements.forEach(function (timerElement) {
                timerElement.textContent = displayText;
            });

            // Increment the time
            taskSeconds++;
        }, 1000);
    }

    

</script>

@if ($task->status == 2)
    <script>
        startTaskTimer({{ $task->task_time_second }});
    </script>
@endif


@endsection