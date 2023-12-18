


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

    .task_div{
        background-color: aliceblue;
        padding: 1%;
    }
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

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    {{-- <h4 class="card-title">Create</h4> --}}
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.invoices.store') }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Date  <span class="error">*</span></label>
                                                    <input type="date" required name="date" value="{{ date('Y-m-d') }}" placeholder="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 ">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column"> Due Date  <span class="error">*</span></label>
                                                    <input type="date" required name="due_date" value="{{ date('Y-m-d') }}" placeholder="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-1">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Project  <span class="error">*</span></label>
                                                    <select name="project_id" required id="project_id" class="select2 form-select">
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
                                                    <select name="user_id" required id="user_id" class="select2 form-select">
                                                        <option value="">(Select Project)</option>
                                                        @foreach ($clients as  $key => $val)
                                                            <option value="{{ $val->user_id }}" {{ ($user_id == $val->user_id) ? 'selected' : '' }} {{ (old('user_id') == $val->user_id) ? 'selected' : '' }} >{{ $val->first_name }} {{ $val->last_name }} </option>    
                                                        @endforeach
                                                    </select>
                                                    @error('user_id')<span class="error">{{ $message }}</span>@enderror
                                                </div>
                                            </div>

                                            {{-- <div  class=" mb-1"> --}}

                                                <div id="targetDiv" class="">

                                                    <div class="col-md-12 row border mb-1 task_div" id="append_div_1" >

                                                        <div class="col-md-6 mb-1" >
                                                            <label class="form-label" for="first-name-column">Task Name 1 <span class="error">*</span></label>
                                                            <input type="number" name="task_1" class="form-control" placeholder="Task Name" required step="any">
                                                        </div>
    
                                                        <div class="col-md-6 mb-1" >
                                                            <label class="form-label" for="first-name-column">Cost <span class="error">*</span></label>
                                                            <input type="number" name="quantity_1" class="form-control all_cost" placeholder="Cost" required step="any" onkeyup = "calculate()">
                                                        </div>
    
                                                        <div class="col-md-12 mb-1" >
                                                            <label class="form-label" for="first-name-column">Description <span class="error">*</span></label>
                                                            <textarea name="description_1" id="" cols="2" rows="2" class="form-control" placeholder="Enter Description"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                

                                                
                                            {{-- </div> --}}

                                            <div class="col-md-12 col-12 mb-1">
                                                <a href="#" class=" btn btn-dark btn-sm btn-add-new"  id="addButton" onclick="appendProduct()">+ Add Product</a>

                                                <a href="#" class=" btn btn-danger btn-sm btn-add-new"  id="remove_button" onclick="removeProduct()">- Remove</a>
                                            </div>

                                            
                                            <div class="col-md-12 col-12 mb-1">
                                                <label for=""></label>
                                            </div>           

                                            <input type="hidden" name="total_tasks" id="total_product_input" value="1">

                                            <div class="card-body invoice-padding">
                                                <div class="row invoice-sales-total-wrapper">

                                                    <div class="col-md-4 order-md-1 order-2 mt-md-0 mt-3">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <label for="salesperson" class="form-label">Tax %:</label>
                                                            <input type="number" class="form-control ms-50" id="tax_rate" placeholder="Tax in percentage" onkeyup = "calculate()" name="tax_rate" value="0" min="0" max="100"/>
                                                        </div>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <label for="salesperson" class="form-label">Paid Amount:</label>
                                                            <input type="number" class="form-control ms-50" id="paid_amount" placeholder="Enter Paid Amount" onkeyup = "calculate()" name="paid_amount"  value="0" min="0" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4 order-md-1 order-2 mt-md-0 mt-3" >

                                                    </div>

                                                    <div class="col-md-4 d-flex justify-content-end order-md-2 order-1">
                                                        <table class="table ">
                                                            <tr>
                                                                <td>Subtotal</td>
                                                                <td id="subtotal">0</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Tax</td>
                                                                <td > <span id="td_tax_rate">0</span>%</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Total</th>
                                                                <th id="td_total">0</th>
                                                            </tr>
                                                            <tr>
                                                                <td>Paid Amount:</td>
                                                                <td id="td_paid_amount">0</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Due Amount</th>
                                                                <th id="td_due_amount">0</th>
                                                            </tr>
                                                        </table>
                                                    </div>
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

    <script>
        let i= 1;
        function appendProduct(){
            i++;
            var contentToAppend = `
                <div class="col-md-12 row border mb-1 task_div" id="append_div_${i}">
                    <div class="col-md-6 mb-1" >
                        <label class="form-label" for="first-name-column">Task Name ${i} <span class="error">*</span></label>
                        <input type="number" name="task_${i}" class="form-control" placeholder="Task Name" required step="any">
                    </div>

                    <div class="col-md-6 mb-1" >
                        <label class="form-label" for="first-name-column">Cost <span class="error">*</span></label>
                        <input type="number" name="quantity_${i}" class="form-control all_cost" placeholder="Cost" required onkeyup = "calculate()" step="any">
                    </div>

                    <div class="col-md-12 mb-1" >
                        <label class="form-label" for="first-name-column">Description <span class="error">*</span></label>
                        <textarea name="description_${i}" id="" cols="2" rows="2" class="form-control" placeholder="Enter Description"></textarea>
                    </div>

                </div>
                `;
                $("#targetDiv").append(contentToAppend);
                document.getElementById('total_product_input').value = i;
                
                var elementToHide = document.getElementById("remove_button");
                if(i < 1){
                    elementToHide.style.display = "none";
                }else{
                    elementToHide.style.display = "";
                }

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

                elementToHide.style.display = "";
                if(i == 1){
                    elementToHide.style.display = "none";
                }
            }

        }


        function calculate(){
            var numberInputs = document.querySelectorAll('input[type="number"].all_cost');
            var subtotal = 0;
            var tax_rate = document.getElementById('tax_rate').value;
            var paid_amount = document.getElementById('paid_amount').value;

            // Loop through the selected elements and add their numeric values to subtotal
            numberInputs.forEach(function(input) {
                // Convert the input value to a number using parseFloat
                var inputValue = parseFloat(input.value);

                // Check if the conversion was successful (not NaN)
                if (!isNaN(inputValue)) {
                    subtotal += inputValue;
                }
            });
            document.getElementById('subtotal').textContent = subtotal;
            document.getElementById('td_tax_rate').textContent = tax_rate;

            var percentValue = tax_rate / 100;

            // Calculate the total with a 20% increase
            var total = subtotal + (subtotal * percentValue);
            document.getElementById('td_total').textContent = total;
            document.getElementById('td_paid_amount').textContent = paid_amount;
            document.getElementById('td_due_amount').textContent = total - paid_amount;
            
            

        }
    </script>
    
@endsection