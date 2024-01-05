
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
                                    <div class="card-header">
                                        <h5 class="mb-75">Task : {{ $item->name }}</h5>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task_detail_{{ $item->id }}"><i data-feather='edit' ></i></a>
                                        


                                        <div class="modal fade" id="task_detail_{{ $item->id }}" tabindex="-1" aria-labelledby="task_detail_{{ $item->id }}Title" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-transparent">
                                                        @if ($item->status == 0)
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-dark">Start</a>
                                                                @elseif ($item->status == 2)
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-danger">On Hold</a>
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-success">For-Review</a>
                                                                @elseif ($item->status == 3)
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-dark">Start</a>
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-success">For-Review</a>
                                                                @else
                                                                    
                                                                @endif
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                    </div>
                                                    <div class="modal-body ">
                                                        <h5 class="text-center mb-1" id="task_detail_{{ $item->id }}Title">Task : {{ $item->name }}</h5>
                                                        <div class="card py-2 my-25 mb-1 border" style="">
                                                            {!! $item->description !!}
                                                        </div>
                                                        <p class="text-center card " ></p>

                                                        <div>
                                                            <h5>Comments</h5>

                                                            @foreach ($item->comments as $comment)

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
                                                        
                        
                                                        <!-- form -->
                                                        <form id="" class="row gy-1 gx-2 mt-75" method="POST" action="{{ route('employee.comments.store') }}">
                                                            @csrf
                        
                                                            <div class="col-6 col-md-12">
                                                                <fieldset class="mb-75">
                                                                    <label class="form-label" for="label-textarea">Add Comment</label>
                                                                    <input type="hidden" name="task_id" value="{{ $item->id }}">
                                                                    <textarea class="form-control" id="label-textarea" rows="3" required name="comment" placeholder="Add Comment"></textarea>
                                                                </fieldset>
                                                                <!--/ comment box -->
                                                                <button type="submit" class="btn btn-sm btn-primary">Post Comment</button>
                                                            </div>
                                                           
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        
                                    </div>
                                    <div class="card-body">
                                        
                                        
                                        <div class="">Date : {{ date('d-M-y',strtotime($item->date)) }}</div>
                                        <div class="">Expected Time : {{ $item->expected_time }}</div>
                                        <div class="">Working Time : {{ $item->expected_time }}</div>

                                        <p>
                                            <h6>Description</h6>
                                            {!! substr(strip_tags($item->description), 0, 100) !!}
                                        </p>

                                        {{-- <div>
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
                                        </div> --}}
                                        
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
                                    <div class="card-header">
                                        <h5 class="mb-75">Task : {{ $item->name }}</h5>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#task_detail_{{ $item->id }}"><i data-feather='edit' ></i></a>
                                        


                                        <div class="modal fade" id="task_detail_{{ $item->id }}" tabindex="-1" aria-labelledby="task_detail_{{ $item->id }}Title" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-transparent">
                                                        @if ($item->status == 0)
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-dark">Start</a>
                                                                @elseif ($item->status == 2)
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-danger">On Hold</a>
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-success">For-Review</a>
                                                                @elseif ($item->status == 3)
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-dark">Start</a>
                                                                    <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-success">For-Review</a>
                                                                @else
                                                                    
                                                                @endif
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                    </div>
                                                    <div class="modal-body ">
                                                        <h5 class="text-center mb-1" id="task_detail_{{ $item->id }}Title">Task : {{ $item->name }}</h5>
                                                        <div class="card py-2 my-25 mb-1 border" style="">
                                                            {!! $item->description !!}
                                                        </div>
                                                        <p class="text-center card " ></p>

                                                        <div>
                                                            <h5>Comments</h5>

                                                            @foreach ($item->comments as $comment)

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
                                                        
                        
                                                        <!-- form -->
                                                        <form id="" class="row gy-1 gx-2 mt-75" method="POST" action="{{ route('employee.comments.store') }}">
                                                            @csrf
                        
                                                            <div class="col-6 col-md-12">
                                                                <fieldset class="mb-75">
                                                                    <label class="form-label" for="label-textarea">Add Comment</label>
                                                                    <input type="hidden" name="task_id" value="{{ $item->id }}">
                                                                    <textarea class="form-control" id="label-textarea" rows="3" required name="comment" placeholder="Add Comment"></textarea>
                                                                </fieldset>
                                                                <!--/ comment box -->
                                                                <button type="submit" class="btn btn-sm btn-primary">Post Comment</button>
                                                            </div>
                                                           
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        
                                    </div>
                                    <div class="card-body">
                                        
                                        
                                        <div class="">Date : {{ date('d-M-y',strtotime($item->date)) }}</div>
                                        <div class="">Expected Time : {{ $item->expected_time }}</div>
                                        <div class="">Working Time : {{ $item->expected_time }}</div>

                                        <p>
                                            <h6>Description</h6>
                                            {!! substr(strip_tags($item->description), 0, 100) !!}
                                        </p>

                                        {{-- <div>
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
                                        </div> --}}
                                        
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
                                <div class="card-header">
                                    <h5 class="mb-75">Task : {{ $item->name }}</h5>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task_detail_{{ $item->id }}"><i data-feather='edit' ></i></a>
                                    


                                    <div class="modal fade" id="task_detail_{{ $item->id }}" tabindex="-1" aria-labelledby="task_detail_{{ $item->id }}Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-transparent">
                                                    @if ($item->status == 0)
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-dark">Start</a>
                                                            @elseif ($item->status == 2)
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-danger">On Hold</a>
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-success">For-Review</a>
                                                            @elseif ($item->status == 3)
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-dark">Start</a>
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-success">For-Review</a>
                                                            @else
                                                                
                                                            @endif
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                </div>
                                                <div class="modal-body ">
                                                    <h5 class="text-center mb-1" id="task_detail_{{ $item->id }}Title">Task : {{ $item->name }}</h5>
                                                    <div class="card py-2 my-25 mb-1 border" style="">
                                                        {!! $item->description !!}
                                                    </div>
                                                    <p class="text-center card " ></p>

                                                    <div>
                                                        <h5>Comments</h5>

                                                        @foreach ($item->comments as $comment)

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
                                                    
                    
                                                    <!-- form -->
                                                    <form id="" class="row gy-1 gx-2 mt-75" method="POST" action="{{ route('employee.comments.store') }}">
                                                        @csrf
                    
                                                        <div class="col-6 col-md-12">
                                                            <fieldset class="mb-75">
                                                                <label class="form-label" for="label-textarea">Add Comment</label>
                                                                <input type="hidden" name="task_id" value="{{ $item->id }}">
                                                                <textarea class="form-control" id="label-textarea" rows="3" required name="comment" placeholder="Add Comment"></textarea>
                                                            </fieldset>
                                                            <!--/ comment box -->
                                                            <button type="submit" class="btn btn-sm btn-primary">Post Comment</button>
                                                        </div>
                                                       
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    
                                </div>
                                <div class="card-body">
                                    
                                    
                                    <div class="">Date : {{ date('d-M-y',strtotime($item->date)) }}</div>
                                    <div class="">Expected Time : {{ $item->expected_time }}</div>
                                    <div class="">Working Time : {{ $item->expected_time }}</div>

                                    <p>
                                        <h6>Description</h6>
                                        {!! substr(strip_tags($item->description), 0, 100) !!}
                                    </p>

                                    {{-- <div>
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
                                    </div> --}}
                                    
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
                                <div class="card-header">
                                    <h5 class="mb-75">Task : {{ $item->name }}</h5>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#task_detail_{{ $item->id }}"><i data-feather='edit' ></i></a>
                                    


                                    <div class="modal fade" id="task_detail_{{ $item->id }}" tabindex="-1" aria-labelledby="task_detail_{{ $item->id }}Title" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header bg-transparent">
                                                    @if ($item->status == 0)
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-dark">Start</a>
                                                            @elseif ($item->status == 2)
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 3 ]) }}" onclick="return confirm('Are you sure you want to on-hold task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-danger">On Hold</a>
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-success">For-Review</a>
                                                            @elseif ($item->status == 3)
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 2 ]) }}" onclick="return confirm('Are you sure you want to start task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-dark">Start</a>
                                                                <a href="{{ route('employee.tasks.change_status',['id' => $item->id ,'status' => 4 ]) }}" onclick="return confirm('Are you sure you want to complete task : {{ $item->name }}?')" class=" me-1 mt-1 btn btn-success">For-Review</a>
                                                            @else
                                                                
                                                            @endif
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                                </div>
                                                <div class="modal-body ">
                                                    <h5 class="text-center mb-1" id="task_detail_{{ $item->id }}Title">Task : {{ $item->name }}</h5>
                                                    <div class="card py-2 my-25 mb-1 border" style="">
                                                        {!! $item->description !!}
                                                    </div>
                                                    <p class="text-center card " ></p>

                                                    <div>
                                                        <h5>Comments</h5>

                                                        @foreach ($item->comments as $comment)

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
                                                    
                    
                                                    <!-- form -->
                                                    <form id="" class="row gy-1 gx-2 mt-75" method="POST" action="{{ route('employee.comments.store') }}">
                                                        @csrf
                    
                                                        <div class="col-6 col-md-12">
                                                            <fieldset class="mb-75">
                                                                <label class="form-label" for="label-textarea">Add Comment</label>
                                                                <input type="hidden" name="task_id" value="{{ $item->id }}">
                                                                <textarea class="form-control" id="label-textarea" rows="3" required name="comment" placeholder="Add Comment"></textarea>
                                                            </fieldset>
                                                            <!--/ comment box -->
                                                            <button type="submit" class="btn btn-sm btn-primary">Post Comment</button>
                                                        </div>
                                                       
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    
                                </div>
                                <div class="card-body">
                                    
                                    
                                    <div class="">Date : {{ date('d-M-y',strtotime($item->date)) }}</div>
                                    <div class="">Expected Time : {{ $item->expected_time }}</div>
                                    <div class="">Working Time : {{ $item->expected_time }}</div>

                                    <p>
                                        <h6>Description</h6>
                                        {!! substr(strip_tags($item->description), 0, 100) !!}
                                    </p>

                                    {{-- <div>
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
                                    </div> --}}
                                    
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