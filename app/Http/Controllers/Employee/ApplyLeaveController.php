<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\ApplyLeave;
use App\Http\Requests\StoreApplyLeaveRequest;
use App\Http\Requests\UpdateApplyLeaveRequest;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class ApplyLeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_search = $request->input('search');
        $apply_leaves = ApplyLeave::orderBy('apply_leaves.id', 'desc')->select('apply_leaves.*','users.first_name as client_first_name','users.last_name as client_last_name')
            ->when($query_search, function ($query) use ($query_search) {
                $query->whereDate('apply_leaves.start_date', 'like', '%' . $query_search . '%') 
                ->orWhereDate('apply_leaves.end_date', 'like', '%' . $query_search . '%')
                ->orWhere('apply_leaves.name', 'like', '%' . $query_search . '%')
                ->orWhere('apply_leaves.client', 'like', '%' . $query_search . '%')
                ->orWhere('users.first_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.last_name', 'like', '%' . $query_search . '%')
                ->orWhere('apply_leaves.category', 'like', '%' . $query_search . '%');
            })
            ->join('users', 'apply_leaves.user_id', '=', 'users.id') // Join with the 'users' table
            ->paginate(10);

            foreach($apply_leaves as $key=>$val){
                $leave_request = LeaveRequest::where('apply_lead_id',$val->id);
                $leave_date_request = $leave_request->pluck('date')->toArray();
                $val['type'] = config("constant.leave_reasones.$val->type");
                $val['date'] = $joinedDateString = implode(',', $leave_date_request);
                $val['leave_days'] = $leave_request->count();
                $val['approved_leave'] = 0;
            }

        if ($request->ajax()) {
            return view('employee.apply_leaves.pagination', compact('apply_leaves'))->render();
        }
        return view('employee.apply_leaves.index', compact('apply_leaves'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.apply_leaves.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreApplyLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplyLeaveRequest $request)
    {
        
        $dates = explode(",",$request->date);
        $apply_leave = ApplyLeave::create([
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'description' => $request->description
        ]);
        foreach($dates as $date){
            LeaveRequest::create([
                'apply_lead_id' => $apply_leave->id,
                'date' => $date
            ]);
        }
        return redirect()->route('employee.apply_leaves.index')->with('success','Leave Apply successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApplyLeave  $applyLeave
     * @return \Illuminate\Http\Response
     */
    public function show(ApplyLeave $applyLeave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ApplyLeave  $applyLeave
     * @return \Illuminate\Http\Response
     */
    public function edit(ApplyLeave $applyLeave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateApplyLeaveRequest  $request
     * @param  \App\Models\ApplyLeave  $applyLeave
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateApplyLeaveRequest $request, ApplyLeave $applyLeave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ApplyLeave  $applyLeave
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApplyLeave $applyLeave)
    {
        //
    }
}
