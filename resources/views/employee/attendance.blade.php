@extends('employee.layouts.app')

@section('content')
<style>
    .date_content .card{
        text-align: center;
        padding: 2%;
        box-shadow: 0 0 10px 1px rgb(160 160 160 / 70%);
        background: #dedede;
    }
    .holiday{
        background: #faaf6f !important;
        color: white;
    }
    .present{
        background: #8ec68a !important;
        color: white;
    }
    .absent{
        background: #ea6868 !important;
        color: white;
    }
    .paid_leave{
        background: #b691d3 !important;
        color: white;
    }
    .casual_leave{
        background: #eda3a3 !important;
        color: white;
    }
    .paid_casual_leave{
        /* background: #eda3a3; */
        /* background: linear-gradient(to right, #b691d3 50%, #eda3a3 50%); */
        background: linear-gradient(to bottom right, #b691d3 50%, #eda3a3 50%) !important;
        color: white;
    }
    .half_present{
        /* background: #eda3a3; */
        /* background: linear-gradient(to right, #b691d3 50%, #eda3a3 50%); */
        background: linear-gradient(to bottom right, #ea6868 50%, #8ec68a 50%) !important;
        color: white;
    }
    
</style>
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Employee</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('employee.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('employee.apply_leaves.index') }}">leaves</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#"></a>
                                </li>
                                <li class="breadcrumb-item active"> Account
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
                <div class="mb-1 breadcrumb-right">
                    <div class="dropdown">
                        <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                        <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="app-todo.html"><i class="me-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="me-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="me-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="me-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        @foreach ($datesArray as $item)
                            <div class="col-md-3 date_content">
                                <div class="card {{ $item['type'] }}" >
                                    <h2 style="color: white;font-weight: 700;">{{ date('d',strtotime($item['date'])) }}</h2>
                                    <h5>{{ date('l',strtotime($item['date'])) }}</h5>
                                </div>
                                
                            </div>    
                        @endforeach
                    </div>
                </div>

                <div class="col-md-1">

                </div>
                <div class="col-md-3">
                    <div class="row">
                        
                            <div class="col-md-12 date_content">
                                <div class="card present" >
                                    <h3 style="color: white">Present</h3>
                                    <h3>0</h3>
                                </div>
                            </div>  

                            <div class="col-md-12 date_content">
                                <div class="card absent" >
                                    <h3 style="color: white">Absent</h3>
                                    <h3>0</h3>
                                </div>
                            </div>  

                            <div class="col-md-12 date_content">
                                <div class="card holiday" >
                                    <h3 style="color: white">Holiday</h3>
                                    <h3>0</h3>
                                </div>
                            </div>    

                            <div class="col-md-12 date_content">
                                <div class="card paid_leave" >
                                    <h3 style="color: white">Paid Leave</h3>
                                    <h3>0</h3>
                                </div>
                            </div>   
                            
                            <div class="col-md-12 date_content">
                                <div class="card casual_leave" >
                                    <h3 style="color: white">Casual Leave</h3>
                                    <h3>0</h3>
                                </div>
                            </div>   
                             
                    </div>
                </div>

                
            </div>
            

        </div>
    </div>
</div>

@endsection