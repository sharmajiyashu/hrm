
<div class="table-responsive">
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
           
           


<script>
    feather.replace();
</script>

