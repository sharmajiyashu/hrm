<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Employee;
use App\Models\Project;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_search = $request->input('search');
        $tasks = Task::orderBy('tasks.id', 'desc')->select('tasks.*','users.first_name as first_name','users.last_name as last_name','projects.name as project_name')
            ->when($query_search, function ($query) use ($query_search) {
                $query->whereDate('projects.start_date', 'like', '%' . $query_search . '%') 
                ->orWhereDate('projects.end_date', 'like', '%' . $query_search . '%')
                ->orWhere('projects.name', 'like', '%' . $query_search . '%')
                ->orWhere('projects.client', 'like', '%' . $query_search . '%')
                ->orWhere('users.first_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.last_name', 'like', '%' . $query_search . '%')
                ->orWhere('projects.category', 'like', '%' . $query_search . '%');
            })
            ->join('users', 'tasks.user_id', '=', 'users.id') // Join with the 'users' table
            ->join('projects', 'tasks.project_id', '=', 'projects.id') // Join with the 'users' table
            ->paginate(10);

        if ($request->ajax()) {
            return view('admin.tasks.pagination', compact('tasks'))->render();
        }
        return view('admin.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::get(); 
        $projects = Project::get();
        return view('admin.tasks.create',compact('employees','projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        $expected_time = $request->expected_time;
        $currentTime = Carbon::createFromTimeString('00:00:00');
        if($request->expected_time_in == 'hour'){
            $endTime = $currentTime->addHours($expected_time);
        }elseif($request->expected_time_in == 'minute'){
            $endTime = $currentTime->addMinutes($expected_time);
        }
        $data = $request->validated();
        $data['expected_time'] = $endTime->format('H:i:s');
        Task::create($data);
        return redirect()->route('admin.tasks.index')->with('success','Task create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
    }
}
