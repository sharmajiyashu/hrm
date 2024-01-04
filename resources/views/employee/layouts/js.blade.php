<!-- BEGIN: Vendor JS-->
<script src="{{ asset('public/admin/app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('public/admin/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
<!-- END: Page Vendor JS-->



<!-- BEGIN: Theme JS-->
<script src="{{ asset('public/admin/app-assets/js/core/app-menu.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('public/admin/app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
<!-- END: Page JS-->
<script src="{{ asset('public/sweet-alert/sweet.min.js') }}"></script>

<script src="{{ asset('public/admin/app-assets/js/scripts/components/components-popovers.js')}}"></script>


<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
</script>

@if (session('success'))
    <script>
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        }); 

        var audio = new Audio('{{ asset('public/sweet-alert/success.mp3') }}'); // Adjust the path to your sound file
        audio.play();
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            title: 'Failure!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });

        var audio = new Audio('{{ asset('public/sweet-alert/error.mp3') }}'); // Adjust the path to your sound file
        audio.play();
    </script>
@endif



<script src="{{ asset('public/admin/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/js/scripts/forms/form-select2.js')}}"></script>

<script src="{{ asset('public/admin/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
<script src="{{ asset('public/admin/app-assets/js/scripts/forms/pickers/form-pickers.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
     // Get all elements with the 'timer' class
    

   });
   

   let timerInterval; // Variable to store the interval ID

    function getTime(second) {
        startAscendingTimer(second);
    }

    function startAscendingTimer(second) {
        let seconds = second;
        // Update the timer every second
        timerInterval = setInterval(function () {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const remainingSeconds = seconds % 60;

            // Display the timer in the specified format
            const displayText = `${hours}:${minutes < 10 ? '0' : ''}${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;

            const timerElements = document.querySelectorAll('.punch_time');
            timerElements.forEach(function (timerElement) {
                timerElement.textContent = displayText;
            });

            // Increment the time
            seconds++;
        }, 1000);
    }

    function stopTimer() {
        // Clear the interval when the button is clicked
        clearInterval(timerInterval);
        console.log("Timer stopped!");
    }
   </script>





{{-- punch time function --}}

<script>
    function punchIn(){
        $.ajax({
            url: "{{ route('employee.punch_in') }}",
            type: 'GET',
            dataType: 'json', // Specify the expected data type
            success: function (data) {
                if(data.status == 1){
                    getPunchTimer();
                    Swal.fire({
                        title: 'Success!',
                        text: 'Punch In Successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }); 

                    var audio = new Audio('{{ asset('public/sweet-alert/success.mp3') }}'); // Adjust the path to your sound file
                    audio.play();
                }
            },
            error: function (error) {   
                console.log(error);
            }
        });
    }

    function breakIn(){
        $.ajax({
            url: "{{ route('employee.break_in') }}",
            type: 'GET',
            dataType: 'json', // Specify the expected data type
            success: function (data) {
                if(data.status == 1){
                    getPunchTimer();
                    Swal.fire({
                        title: 'Success!',
                        text: 'Break In Successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }); 

                    var audio = new Audio('{{ asset('public/sweet-alert/success.mp3') }}'); // Adjust the path to your sound file
                    audio.play();
                }
            },
            error: function (error) {   
                console.log(error);
            }
        });
    }

    function breakOut(){
        $.ajax({
            url: "{{ route('employee.break_out') }}",
            type: 'GET',
            dataType: 'json', // Specify the expected data type
            success: function (data) {
                if(data.status == 1){
                    getPunchTimer();
                    Swal.fire({
                        title: 'Success!',
                        text: 'Break out Successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }); 

                    var audio = new Audio('{{ asset('public/sweet-alert/success.mp3') }}'); // Adjust the path to your sound file
                    audio.play();
                }
            },
            error: function (error) {   
                console.log(error);
            }
        });
    }

    function punchOut(){
        $.ajax({
            url: "{{ route('employee.punch_out') }}",
            type: 'GET',
            dataType: 'json', // Specify the expected data type
            success: function (data) {
                if(data.status == 1){
                    getPunchTimer();
                    Swal.fire({
                        title: 'Success!',
                        text: 'Break out Successfully',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }); 

                    var audio = new Audio('{{ asset('public/sweet-alert/success.mp3') }}'); // Adjust the path to your sound file
                    audio.play();
                }
            },
            error: function (error) {   
                console.log(error);
            }
        });
    }


    function getPunchTimer(){
        $.ajax({
                url: "{{ route('employee.get_punch_time') }}",
                type: 'GET',
                dataType: 'json', // Specify the expected data type
                success: function (data) {
                    document.getElementById('punch_out_button').style.display = 'none';
                    document.getElementById('break_in_button').style.display = 'none';
                    document.getElementById('punch_in_button').style.display = 'none';
                    document.getElementById('break_out_button').style.display = 'none';
                    if(data.status == 1){ // on simple time
                        getTime(data.second);
                        document.getElementById('punch_out_button').style.display = '';
                        document.getElementById('break_in_button').style.display = '';
                    }else if(data.status == 0){ // no punch in
                        document.getElementById('punch_in_button').style.display = '';
                    }else if(data.status == 2){ // on break
                        var timerElements = document.querySelectorAll('.punch_time');
                        timerElements.forEach(function (timerElement) {
                            timerElement.textContent = data.time;
                        });
                        document.getElementById('punch_out_button').style.display = '';
                        document.getElementById('break_out_button').style.display = '';
                        clearInterval(timerInterval);
                    }else if(data.status == 3){
                        var timerElements = document.querySelectorAll('.punch_time');
                        timerElements.forEach(function (timerElement) {
                            timerElement.textContent = data.time;
                        });
                        // document.getElementById('punch_out_button').style.display = '';
                        // document.getElementById('break_out_button').style.display = '';
                        clearInterval(timerInterval);
                    }

                    document.getElementById('punch_time_message').textContent = data.message;
                },
                error: function (error) {
                    console.log(error);
                }
            });
    }


</script>

<script>
    $(document).ready(function () {
        getPunchTimer();
        getInprocessingtask();
    });
</script>


<script>
    function getInprocessingtask(){
        $.ajax({
                url: "{{ route('employee.get_in_processing_task') }}",
                type: 'GET',
                dataType: 'json', // Specify the expected data type
                success: function (data) {
                    if (data.length != 0) {

                        let task_id = data.id;

                        var on_hold_url = `{{ route('employee.tasks.change_status', ['id' => 'task_id', 'status' => 3]) }}`;
                        on_hold_url = on_hold_url.replace('task_id',task_id);

                        var complete_url = `{{ route('employee.tasks.change_status', ['id' => 'task_id', 'status' => 1]) }}`;
                        complete_url = complete_url.replace('task_id',task_id);
                        console.log(data);
                        document.getElementById("task_timer_detail").innerHTML = `
                            <div class="offcanvas-header">
                                <h5 id="offcanvasBottomLabel" class="offcanvas-title task_timer">Task : ${data.name}</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <div class="row">
                                    <div class="col-md-8 mb-1 card py-2 my-25" style="border: solid 1px ">
                                        <h3>Description</h3>
                                        <div>${data.description}</div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-1" >
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th>Task Name</th>
                                                        <td> ${data.name}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Expected Time</th>
                                                        <td>${data.expected_time}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Working Time</th>
                                                        <td ><span class="task_timer">-</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Date</th>
                                                        <td ><span class="">${data.date}</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="mb-1">
                                            <a href="${on_hold_url}" onclick="return confirm('Are you sure you want to on-hold task : ${data.name}?')" class="btn btn-danger">On Hold</a>
                                            <a href="${complete_url}" onclick="return confirm('Are you sure you want to complete task : ${data.name}?')" class="btn btn-success">Complete</a>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                                        </div>

                                        
                                    </div>
                                </div>
                                
                            </div>
                        `;
                        startTaskTimer(data.task_time_secound);
                    }else{
                        document.getElementById("task_timer_detail").innerHTML  = `   <div class="offcanvas-header">
                                <h5 id="offcanvasBottomLabel" class="offcanvas-title ">No Active Task</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <h5>No active task. Please go to the task sheet and start a task to initiate the task timer.</h5>
                                <p>
                                    
                                </p>
                                <a href="{{ route('employee.tasks.index') }}" class="btn btn-primary">Task Sheet</a>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
                            </div>
                            `  ; 
                    }
                    

                },
                
                error: function (error) {
                    console.log(error);
                }
            });
    }


    function startTaskTimer(second) {
        let seconds = second;
        // Update the timer every second
        timerInterval = setInterval(function () {
            const hours = Math.floor(seconds / 3600);
            const minutes = Math.floor((seconds % 3600) / 60);
            const remainingSeconds = seconds % 60;

            // Display the timer in the specified format
            const displayText = `${hours}:${minutes < 10 ? '0' : ''}${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;

            const timerElements = document.querySelectorAll('.task_timer');
            timerElements.forEach(function (timerElement) {
                timerElement.textContent = displayText;
            });

            // Increment the time
            seconds++;
        }, 1000);
    }
</script>
