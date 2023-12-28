@extends('admin.layouts.app')

@section('content')

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
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.leaves.index') }}">leaves</a>
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
                <div class="col-12">
                    <!-- profile -->
                    <div class="card">
                        <div class="card-header border-bottom">
                            <h4 class="card-title">Profile Details</h4>
                            <h3>Paid leaves : <span id="paid_leaves_span" class="text-success">{{ $paid_leaves }}</span></h3>
                        </div>
                        <div class="card-body">
                            
                            <form class="validate-form mt-2 " action="{{ route('admin.leaves.approved_leaves') }}" method="POST">
                                @csrf
                                <div class="row">

                                    <div class="col-12 col-sm-6 mb-1">
                                        <label class="form-label" for="country">Leave type</label>
                                        <input type="hidden" name="apply_id" id="" value="{{ $applyLeave->id }}">
                                        <select id="country" class="select2 form-select">
                                            <option value="">Select Country</option>
                                            @foreach (config('constant.leave_reasones') as $key => $val)
                                                <option value="{{ $key }}" {{ ($applyLeave->type == $key) ? 'selected' : '' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 col-sm-6 mb-1">
                                        <label for="">Status</label><br><br>
                                        <div class="form-check-danger form-check-inline">
                                            <input class="form-check-input"  type="radio" name="status"  value="3" checked  />
                                            <label class="form-check-label" for="inlineRadio1">Reject</label>
                                        </div>
                                        <div class="form-check-success form-check-inline">
                                            <input class="form-check-input" type="radio"  name="status"  value="1" 
                                                @if ($applyLeave->status == 1) checked @endif
                                            />
                                            <label class="form-check-label" for="inlineRadio2">Approved</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                               <tr>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Type</th>
                                               </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = 1; ?>
                                                @foreach ($leave_requests as $item)
                                                <tr>
                                                    <td><div class="d-flex align-items-center">
                                                        <div class="avatar bg-light-primary me-1">
                                                            <div class="avatar-content">
                                                                <i data-feather="calendar" class="font-medium-3"></i>
                                                            </div>
                                                        </div>
                                                        <span><strong>{{ $item->date }}</strong></span>
                                                    </div></td>
                                                    <td>
                                                        <div class="form-check-danger form-check-inline">
                                                            <input class="form-check-input " type="radio" name="status_{{ $item->id }}" id="inlineRadio1" value="reject" checked  onchange="getPaidLeaves()"/>
                                                            <label class="form-check-label" for="inlineRadio1">Reject</label>
                                                        </div>
                                                        <div class="form-check-success form-check-inline">
                                                            <input class="form-check-input approved" type="radio" name="status_{{ $item->id }}" id="{{ $item->id }}" value="approved"  onchange="getPaidLeaves()"
                                                                @if ($item->status == 1) checked @endif
                                                            
                                                            />
                                                            <label class="form-check-label" for="inlineRadio2">Approved</label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span id="span_value_{{ $item->id }}">
                                                            @if ($item->type == 1)
                                                                P/L
                                                            
                                                            @elseif ($item->type == 2)
                                                                Half : P/L , Half : C/L
                                                            @elseif ($item->type == 3)
                                                                CL
                                                            @else
                                                                
                                                            @endif
                                                        </span>
                                                    </td>
                                                </tr>    
                                                <?php $i++;  ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6">
                                        <table class="table">
                                            <tr>
                                                <th>Paid leave</th>
                                                <td><span id="paid_leave_span">0</span></td>
                                            </tr>
                                            <tr>
                                                <th>Casual leave</th>
                                                <td><span id="casual_leave_span">0</span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    
                                    <div class="col-12">
                                        <input type="hidden" name="leaves_status" value="" id="leaves_status">
                                        <button type="submit" class="btn btn-primary mt-1 me-1">Save changes</button>
                                        <button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
                                    </div>
                                </div>
                            </form>
                            <!--/ form -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function getPaidLeaves(){
        var approvedRadios = document.querySelectorAll('input[type="radio"].approved');
        let i = 1;
        let total_paid_leaves = {{ $paid_leaves }};
        let paid_leave = 0;
        let casual_leave = 0;
        let my_data = [];
        approvedRadios.forEach(function(radio) {
            if (radio.checked) {
                if (total_paid_leaves == 0.5) {
                    total_paid_leaves -= 0.5;
                    document.getElementById('span_value_' + radio.id).textContent = `Half : P/L , Half : C/L`;
                    paid_leave  += 0.5;
                    casual_leave  += 0.5;
                    my_data.push([radio.id,'2']);
                } else if (total_paid_leaves > 1) {
                    total_paid_leaves -= 1;
                    document.getElementById('span_value_' + radio.id).textContent = "P/L";
                    paid_leave += 1;
                    my_data.push([radio.id,'1']);
                }else if(total_paid_leaves == 0){
                    document.getElementById('span_value_' + radio.id).textContent = "C/L";
                    casual_leave += 1;
                    my_data.push([radio.id,'3']);
                }
                i ++;
            } else {
                document.getElementById('span_value_' + radio.id).textContent = " ";
            }
        });
        document.getElementById('paid_leaves_span').textContent = total_paid_leaves;
        document.getElementById('casual_leave_span').textContent = casual_leave;
        document.getElementById('paid_leave_span').textContent = paid_leave;

        let jsonString = JSON.stringify(my_data);
        document.getElementById("leaves_status").value = jsonString;
        // console.log(my_data);
    }

    window.onload = function() {
        getPaidLeaves();
    };
</script>
@endsection