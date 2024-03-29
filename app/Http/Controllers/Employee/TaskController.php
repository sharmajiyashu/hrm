<?php

namespace App\Http\Controllers\Employee;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Employee;
use App\Models\ManagerMap;
use App\Models\Project;
use App\Models\TaskComment;
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
        $date_search = $request->input('date');
        $product_search = $request->input('product');
        $status_search = $request->input('status');
        $qa_status_search = $request->input('qa_status');
        
        $tasks = Task::orderBy('tasks.id', 'desc')->select('tasks.*','users.first_name as first_name','users.last_name as last_name','projects.name as project_name')
            ->when($query_search, function ($query) use ($query_search) {
                $query->orWhere('tasks.name', 'like', '%' . $query_search . '%') 
                ->orWhere('projects.name', 'like', '%' . $query_search . '%')
                ->orWhere('tasks.description', 'like', '%' . $query_search . '%');
            })->when($date_search, function ($query) use ($date_search) {
                $query->whereDate('tasks.date', 'like', '%' . $date_search . '%') ;
            })
            ->when($product_search, function ($query) use ($product_search) {
                $product_search = json_decode($product_search);
                if(!empty($product_search)){
                    $query->whereIn('projects.id', $product_search) ;
                }
            })
            ->when($status_search, function ($query) use ($status_search) {
                $status_search = json_decode($status_search);
                if(!empty($status_search)){
                    $query->whereIn('tasks.status', $status_search) ;
                }
            })
            ->when($qa_status_search, function ($query) use ($qa_status_search) {
                $qa_status_search = json_decode($qa_status_search);
                if(!empty($qa_status_search)){
                    $query->whereIn('tasks.qa_status', $qa_status_search) ;
                }
            })
            ->where('users.id',auth()->user()->id)
            ->join('users', 'tasks.user_id', '=', 'users.id') // Join with the 'users' table
            ->join('projects', 'tasks.project_id', '=', 'projects.id') // Join with the 'users' table
            ->paginate(10);
            foreach($tasks as $key=>$val){
                $task_time = Helper::getTaskTime($val->id);
                $val['task_time'] = isset($task_time[0]) ? $task_time[0] :'';
                $val['task_time_second'] = isset($task_time[1]) ? $task_time[1] :'';
            }
        if ($request->ajax()) {
            return view('employee.tasks.pagination', compact('tasks'))->render();
        }

        $projects = Project::get();
        return view('employee.tasks.index', compact('tasks','projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manager_project_ids = ManagerMap::where('user_id',auth()->user()->id)->pluck('project_id')->toArray();
        $projects = Project::whereIn('id',$manager_project_ids)->get();
        $employees = Employee::get();
        return view('employee.tasks.create',compact('employees','projects'));
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
        $task = Task::create($data);
        TaskComment::create(['user_id' => auth()->user()->id ,'task_id' => $task->id , 'comment' => "Task has been created ".date('d M ,H:i:s') ]);
        return redirect()->route('employee.tasks.index')->with('success','Task create successfully');
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
        $task->comments = TaskComment::select('task_comments.*','users.first_name','users.last_name')->where('task_comments.task_id',$task->id)->join('users','users.id','task_comments.user_id')->get();
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
            Task::where('user_id',auth()->user()->id)->where('status',Task::$in_processing)->get()->map(function($task){
                $task_time = TaskTime::where('task_id',$task->id)->orderBy('id','desc')->first();
                if(empty($task_time->end_time)){
                    TaskTime::where('id',$task_time->id)->update(['end_time' => date('Y-m-d H:i:s')]);
                }
                $task->update(['status' => Task::$on_hold]);
            });
            Task::where('id',$request->id)->where('user_id',auth()->user()->id)->update(['status' => Task::$in_processing ,'qa_status' => '0']);
            TaskTime::create([
                'task_id' => $request->id,
                'start_time' => date('Y-m-d H:i:s'),
            ]);
            TaskComment::create(['user_id' => auth()->user()->id ,'task_id' => $request->id , 'comment' => "Task On processing at ".date('d M ,H:i:s') ]);
            return redirect()->back()->with('success','Task start successfully');
        }elseif($request->status == Task::$complete){
            Task::where('id',$request->id)->where('user_id',auth()->user()->id)->update(['status' => Task::$complete]);            
            $task_time = TaskTime::where('task_id',$request->id)->orderBy('id','DESC')->first();
            $task_time->update([
                'end_time' => date('Y-m-d H:i:s'),
            ]);
            TaskComment::create(['user_id' => auth()->user()->id ,'task_id' => $request->id , 'comment' => "Task complete at ".date('d M ,H:i:s') ]);
            return redirect()->back()->with('success','Task complete successfully');
        }elseif($request->status == Task::$on_hold){
            Task::where('id',$request->id)->where('user_id',auth()->user()->id)->update(['status' => Task::$on_hold]);            
            $task_time = TaskTime::where('task_id',$request->id)->orderBy('id','DESC')->first();
            if(!empty($task_time)){
                $task_time->update([
                    'end_time' => date('Y-m-d H:i:s'),
                ]);
            }
            TaskComment::create(['user_id' => auth()->user()->id ,'task_id' => $request->id , 'comment' => "Task On Hold at ".date('d M ,H:i:s') ]);
            return redirect()->back()->with('success','Task on-hold');
        }elseif($request->status == Task::$for_review){
            Task::where('id',$request->id)->where('user_id',auth()->user()->id)->update(['status' => Task::$for_review]);            
            $task_time = TaskTime::where('task_id',$request->id)->orderBy('id','DESC')->first();
            if(!empty($task_time)){
                $task_time->update([
                    'end_time' => date('Y-m-d H:i:s'),
                ]);
            }
            TaskComment::create(['user_id' => auth()->user()->id ,'task_id' => $request->id , 'comment' => "Task for review at ".date('d M ,H:i:s') ]);
            return redirect()->back()->with('success','Task On for review');
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


    function lists(){
        $pending_tasks = Task::get()->map(function($task){
            $task->comments = TaskComment::select('task_comments.*','users.first_name','users.last_name')->where('task_comments.task_id',$task->id)->join('users','users.id','task_comments.user_id')->get();
            return $task;
        });
        return view('employee.tasks.lists',compact('pending_tasks'));
    }

    function testing(Request $request){
        $manager_project_ids = ManagerMap::where('user_id',auth()->user()->id)->pluck('project_id')->toArray();
        $query_search = $request->input('search');
        $date_search = $request->input('date');
        $product_search = $request->input('product');
        $status_search = $request->input('status');
        $qa_status_search = $request->input('qa_status');
        $tasks = Task::orderBy('tasks.id', 'desc')->select('tasks.*','users.first_name as first_name','users.last_name as last_name','projects.name as project_name')
            ->when($query_search, function ($query) use ($query_search) {
                $query->orWhere('tasks.name', 'like', '%' . $query_search . '%') 
                ->orWhere('projects.name', 'like', '%' . $query_search . '%')
                ->orWhere('tasks.description', 'like', '%' . $query_search . '%');
            })->when($date_search, function ($query) use ($date_search) {
                $query->whereDate('tasks.date', 'like', '%' . $date_search . '%') ;
            })
            ->when($product_search, function ($query) use ($product_search) {
                $product_search = json_decode($product_search);
                if(!empty($product_search)){
                    $query->whereIn('projects.id', $product_search) ;
                }
            })
            ->when($status_search, function ($query) use ($status_search) {
                $status_search = json_decode($status_search);
                if(!empty($status_search)){
                    $query->whereIn('tasks.status', $status_search) ;
                }
            })
            ->when($qa_status_search, function ($query) use ($qa_status_search) {
                $qa_status_search = json_decode($qa_status_search);
                if(!empty($qa_status_search)){
                    $query->whereIn('tasks.qa_status', $qa_status_search) ;
                }
            })
            // ->where('users.id',auth()->user()->id)
            ->join('users', 'tasks.user_id', '=', 'users.id') // Join with the 'users' table
            ->join('projects', 'tasks.project_id', '=', 'projects.id') // Join with the 'users' table
            ->whereIn('projects.id',$manager_project_ids)
            ->paginate(10);
            foreach($tasks as $key=>$val){
                $task_time = Helper::getTaskTime($val->id);
                $val['task_time'] = isset($task_time[0]) ? $task_time[0] :'';
                $val['task_time_second'] = isset($task_time[1]) ? $task_time[1] :'';
            }
        if ($request->ajax()) {
            return view('employee.tasks.pagination', compact('tasks'))->render();
        }

        $projects = Project::get();
        return view('employee.tasks.testing', compact('tasks','projects'));
    }

    function updateQaStatus (Request $request){
        if($request->qa_status == 1){
            Task::where('id',$request->id)->update([
                'status' => '1',
                'qa_status' => $request->qa_status,
            ]);
            TaskComment::create(['user_id' => auth()->user()->id ,'task_id' => $request->id , 'comment' => "Task complete at  ".date('d M ,H:i:s') ]);
            return redirect()->back()->with('success','Task complete successfully');
        }elseif($request->qa_status == 2){
            Task::where('id',$request->id)->update([
                'status' => '0',
                'qa_status' => $request->qa_status,
            ]);
            TaskComment::create(['user_id' => auth()->user()->id ,'task_id' => $request->id , 'comment' => "Task Re-Opened at  ".date('d M ,H:i:s') ]);
            return redirect()->back()->with('success','Task complete successfully');
        }
    }
    

}
