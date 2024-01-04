<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\TaskTime;
use Carbon\Carbon;
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
            ->where('users.id',auth()->user()->id)
            ->join('users', 'tasks.user_id', '=', 'users.id') // Join with the 'users' table
            ->join('projects', 'tasks.project_id', '=', 'projects.id') // Join with the 'users' table
            ->paginate(10);
        if ($request->ajax()) {
            return view('employee.tasks.pagination', compact('tasks'))->render();
        }
        return view('employee.tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        $get_timer = Helper::getTaskTime($task->id);
        $task->task_time = isset($get_timer[0]) ? $get_timer[0] :'';
        $task->task_time_second = isset($get_timer[1]) ? $get_timer[1] :'';
        return view('employee.tasks.show',compact('task'));
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


    function updateStatus(Request $request){
        if($request->status == Task::$in_processing){
            Task::where('user_id',auth()->user()->id)->where('status',Task::$in_processing)->update(['status' => Task::$on_hold]);
            Task::where('id',$request->id)->where('user_id',auth()->user()->id)->update(['status' => Task::$in_processing]);
            TaskTime::create([
                'task_id' => $request->id,
                'start_time' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with('success','Task start successfully');
        }elseif($request->status == Task::$complete){
            Task::where('id',$request->id)->where('user_id',auth()->user()->id)->update(['status' => Task::$complete]);            
            $task_time = TaskTime::where('task_id',$request->id)->orderBy('id','DESC')->first();
            $task_time->update([
                'end_time' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with('success','Task complete successfully');
        }elseif($request->status == Task::$on_hold){
            Task::where('id',$request->id)->where('user_id',auth()->user()->id)->update(['status' => Task::$on_hold]);            
            $task_time = TaskTime::where('task_id',$request->id)->orderBy('id','DESC')->first();
            $task_time->update([
                'end_time' => date('Y-m-d H:i:s'),
            ]);
            return redirect()->back()->with('success','Task on-hold');
        }
    }


    function getInProcessingTask(){
        $task = Task::where('user_id',auth()->user()->id)->where('status',Task::$in_processing)->orderBy('id','Desc')->first();
        if(!empty($task)){
            $task_time = Helper::getTaskTime($task->id);
            $task->task_time = $task_time[0];
            $task->task_time_secound = $task_time[1];
            return json_encode($task);
        }
        return json_encode([]);
    }


}
