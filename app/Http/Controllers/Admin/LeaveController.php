<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Middleware\AdminMiddleware;
use App\Models\ApplyLeave;
use App\Http\Requests\StoreApplyLeaveRequest;
use App\Http\Requests\UpdateApplyLeaveRequest;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query_search = $request->input('search');
        $leaves = ApplyLeave::orderBy('apply_leaves.id', 'desc')->select('apply_leaves.*','users.first_name as first_name','users.last_name','users.email')
            ->when($query_search, function ($query) use ($query_search) {
                $query->where('employees.gender', 'like', '%' . $query_search . '%')
                ->orWhere('users.first_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.last_name', 'like', '%' . $query_search . '%')
                ->orWhere('users.mobile', 'like', '%' . $query_search . '%')
                ->orWhere('users.email', 'like', '%' . $query_search . '%')
                    ->orWhere('employees.salary', 'like', '%' . $query_search . '%');
            })
            ->join('users', 'apply_leaves.user_id', '=', 'users.id') // Join with the 'users' table
            ->paginate(10);

            foreach($leaves as $key=>$val){
                $leave_request = LeaveRequest::where('apply_lead_id',$val->id);
                $leave_date_request = $leave_request->pluck('date')->toArray();
                $val['type'] = config("constant.leave_reasones.$val->type");
                $val['date'] = $joinedDateString = implode(',', $leave_date_request);
                $val['leave_days'] = $leave_request->count();
                $val['approved_leave'] = 0;
            }

        if ($request->ajax()) {
            return view('admin.leaves.pagination', compact('leaves'))->render();
        }

        return view('admin.leaves.index', compact('leaves'));
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
     * @param  \App\Http\Requests\StoreApplyLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreApplyLeaveRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ApplyLeave  $applyLeave
     * @return \Illuminate\Http\Response
     */
    public function show(ApplyLeave $applyLeave ,$id)
    {
        $paid_leaves = 2.5;
        $applyLeave = ApplyLeave::find($id);
        $leave_requests = LeaveRequest::where('apply_lead_id',$id)->get();
        return view('admin.leaves.show',compact('applyLeave','leave_requests','paid_leaves'));
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


    function approvedLeaves(Request $request){
        $applyLeave = ApplyLeave::find($request->apply_id);
        LeaveRequest::where('apply_lead_id',$applyLeave->id)->update(['status' => '0','type' => '0']);
        $applyLeave->update(['status' => $request->status]);
        if($request->status == '3'){
            
        }elseif($request->status == '1'){  
            if(!empty($request->leaves_status)){
                $leave_status =  json_decode($request->leaves_status);
                foreach($leave_status as $key => $val){
                    $leave_request_id = $val[0];
                    $leave_status =  $val[1];
                    LeaveRequest::where('id',$leave_request_id)->update([
                        'status' => '1',
                        'type' => $leave_status,
                    ]);
                }
            }
        }
        return redirect()->back()->with('success','Leave approved successfully');
    }
}
