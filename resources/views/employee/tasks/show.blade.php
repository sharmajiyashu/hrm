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
        


        <section id="basic-tabs-components">
            <div class="row match-height">
                <!-- Basic Tabs starts -->
                <div class="col-xl-6 col-lg-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4 class="card-title">Basic Tab</h4>
                        </div> --}}
                        <div class="card-body">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" aria-controls="home" role="tab" aria-selected="true"><i data-feather="home"></i>Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="false"><i data-feather="home"></i>Comments</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" aria-labelledby="home-tab" role="tabpanel">
                                    {!! $task->description !!}
                                </div>
                                <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                    @foreach ($task->comments as $comment)

                                    <div class="profile-twitter-feed mt-1">
                                        <div class="d-flex justify-content-start align-items-center mb-1">
                                            <div class="avatar me-1">
                                                <img src="{{ asset('public/admin/app-assets/images/avatars/5-small.png')}}" alt="avatar img" height="40" width="40" />
                                            </div>
                                            <div class="profile-user-info">
                                                <h6 class="mb-0">{{ $comment->first_name }} {{ $comment->last_name }}</h6>
                                                <a href="#">
                                                    {{-- <small class="text-muted">@tiana59</small> --}}
                                                    {{-- <i data-feather="check-circle"></i> --}}
                                                </a>
                                            </div>
                                            <div class="profile-star ms-auto">
                                                {{ date('d-M-y H:i:s',strtotime($comment->created_at)) }}
                                            </div>
                                        </div>
                                        <p class="card-text mb-50">{{ $comment->comment }}</p>
                                        {{-- <a href="#" class="">
                                            <small>#design #fasion</small>
                                        </a> --}}
                                        <div class="border"></div>
                                        
                                    </div>

                                @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Tabs ends -->

                <!-- Tabs with Icon starts -->
                <div class="col-xl-6 col-lg-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4 class="card-title">Tab with icon</h4>
                        </div> --}}
                        <div class="card-body">
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
                                        <tr>
                                            <th>Employee</th>
                                            <td ><span class="">{{ $task->employee_name }}</span></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($task->status == 0)
                                                    <span class="badge rounded-pill badge-light-primary">Pending</span>
                                                @elseif ($task->status == 2)
                                                    <span class="badge rounded-pill badge-light-dark">In Processing</span>
                                                @elseif ($task->status == 1)
                                                    <span class="badge rounded-pill badge-light-success">Complete</span>
                                                @elseif ($task->status == 3)
                                                    <span class="badge rounded-pill badge-light-danger">On-Hold</span>
                                                @elseif ($task->status == 4)
                                                    <span class="badge rounded-pill badge-light-danger">For-Review</span>
                                                @else
                                                    
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Qa Status</th>
                                            <td>
                                                @if ($task->qa_status == 0)
                                                    <span class="badge rounded-pill badge-light-primary">Pending</span>
                                                @elseif ($task->qa_status == 2)
                                                    <span class="badge rounded-pill badge-light-warning">Re-Opened</span>
                                                @elseif ($task->qa_status == 1)
                                                    <span class="badge rounded-pill badge-light-success">Complete</span>
                                                @elseif ($task->qa_status == 3)
                                                    <span class="badge rounded-pill badge-light-danger">On-Hold</span>
                                                @elseif ($task->qa_status == 4)
                                                    <span class="badge rounded-pill badge-light-danger">For-Review</span>
                                                @else
                                                    
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if ($task->user_id == auth()->user()->id)
                                <div class="mb-1">
                                    
                                    <div class="text-center">
                                        @if ($task->status == 0)
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-dark">Start</a>
                                        @elseif ($task->status == 2)
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $task->name }}?')" class="btn btn-danger">On Hold</a>
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $task->name }}?')" class="btn btn-success">For-Review</a>
                                        @elseif ($task->status == 3)
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-dark">Start</a>
                                            <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $task->name }}?')" class="btn btn-success">For-Review</a>
                                        @elseif ($task->status == 4)
                                            {{-- <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $task->name }}?')" class="btn btn-danger">On Hold</a> --}}
                                            {{-- <a href="{{ route('employee.tasks.change_status',['id' => $task->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-dark">Start</a> --}}
                                        @else
                                            
                                        @endif
                                    </div>
                                    
                                </div>    
                            @endif

                            @if ($task->is_manager > 0 && $task->status == 4)

                                <div class="mb-1 " >
                                    
                                    <div class="text-center mb-1">

                                            @if ($task->qa_status == 0)
                                                <a href="{{ route('employee.tasks.change_qa_status',['id' => $task->id ,'qa_status' => 1 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-dark">Complete</a>
                                                <a href="{{ route('employee.tasks.change_qa_status',['id' => $task->id ,'qa_status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-danger">Re-Opened</a>
                                            @elseif ($task->qa_status == 2)
                                                <a href="{{ route('employee.tasks.change_qa_status',['id' => $task->id ,'qa_status' => 1 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-dark">Complete</a>
                                            @elseif ($task->qa_status == 1)
                                                <a href="{{ route('employee.tasks.change_qa_status',['id' => $task->id ,'qa_status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $task->name }}?')" class="btn btn-danger">Re-Opened</a>
                                            @else
                                                
                                            @endif   
                                    </div>
                                    
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Tabs with Icon ends -->
            </div>
        </section>



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