<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\PunchTime;
use App\Http\Requests\StorePunchTimeRequest;
use App\Http\Requests\UpdatePunchTimeRequest;
use App\Models\Breaktime;
use Carbon\Carbon;

class PunchTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePunchTimeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePunchTimeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PunchTime  $punchTime
     * @return \Illuminate\Http\Response
     */
    public function show(PunchTime $punchTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PunchTime  $punchTime
     * @return \Illuminate\Http\Response
     */
    public function edit(PunchTime $punchTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePunchTimeRequest  $request
     * @param  \App\Models\PunchTime  $punchTime
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePunchTimeRequest $request, PunchTime $punchTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PunchTime  $punchTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(PunchTime $punchTime)
    {
        //
    }

    function pubchTime(){
        if(auth()->check()){
        $today = Carbon::today();
        $get_time = PunchTime::where('user_id', auth()->user()->id)->whereDate('created_at', $today)->first();
            if(!empty($get_time)){

                return self::getEmployeetimeStatus(auth()->user()->id,$today);
                
            }else{
                return json_encode([
                    'status' => 0,
                    'time' => 15,
                    'second' => 200,
                    'message' => 'Punch In',
                ]);
            }
        }else{

        }
    }

    function getEmployeetimeStatus($user_id,$time){
        $get_time = PunchTime::where('user_id', auth()->user()->id)->whereDate('created_at', $time)->first();
        $get_break_time = Breaktime::where('user_id', auth()->user()->id)->whereDate('created_at', $time)->orderby('id','desc')->first();
        $startTime = Carbon::parse($get_time->punch_in);
        if(!empty($get_time->punch_out)){
            $endTime = Carbon::parse($get_time->punch_out);
            $punch_out_is = '1';
        }else{
            $endTime = Carbon::now();
        }
        $timeDifferenceInSeconds = $endTime->diffInSeconds($startTime);
        if(!empty($get_break_time)){
            $break_times = Breaktime::where('user_id', auth()->user()->id)->whereDate('created_at', $time)->orderby('id','asc')->get();
            $sum_of_break_second = 0;
            foreach($break_times as $key => $val){
                if(!empty($val->break_in)){
                    $break_start = Carbon::parse($val->break_in);
                }else{
                    $break_start = Carbon::now();
                }
                if(!empty($val->break_out)){
                    $break_end = Carbon::parse($val->break_out);
                }else{
                    $break_end = Carbon::now();
                }
                $timeBreakDifferenceInSeconds = $break_end->diffInSeconds($break_start);
                $sum_of_break_second += $timeBreakDifferenceInSeconds;
            }
            $total_deff_seconds = $timeDifferenceInSeconds - $sum_of_break_second;
            $timeFormatted = gmdate('H:i:s', $total_deff_seconds);
            if(!empty($get_break_time->break_out)){
                $return_data = [
                    'status' => 1,
                    'time' => gmdate('H:i:s', $total_deff_seconds),
                    'second' => $total_deff_seconds,
                    'message' => 'Timer Continue'
                ];
            }else{
                $return_data = [
                    'status' => 2,
                    'time' => $timeFormatted,
                    'second' => $timeDifferenceInSeconds - $sum_of_break_second,
                    'message' => 'On Break'
                ];
            }
        }else{
            $return_data = [
                'status' => 1,
                'time' => gmdate('H:i:s', $timeDifferenceInSeconds),
                'second' => $timeDifferenceInSeconds,
                'message' => 'Timer Continue'
            ];
            
        }
        if($punch_out_is == 1){
            $return_data['status'] = 3;
            $return_data['message'] = 'Punch Out';
        }
        return json_encode($return_data);
    }


    function punchIn(){
        if(auth()->check()){
            $today = Carbon::today();
            $get_time = PunchTime::where('user_id', auth()->user()->id)->whereDate('created_at', $today)->first();
            if(!empty($get_time)){
                return json_encode([
                    'status' => 0,
                ]);
            }else{
                $punch = PunchTime::create([
                    'user_id' => auth()->user()->id,
                    'punch_in' => date('H:i:s'),
                ]);
                return json_encode([
                    'status' => 1,
                ]);
            }
        }else{

        }
    }

    function breakIn(){
        if(auth()->check()){
            $today = Carbon::today();
            $get_time = Breaktime::where('user_id', auth()->user()->id)->whereDate('created_at', $today)->orderBy('id','desc')->first();
            if(!empty($get_time)){
                if(!empty($get_time->break_out)){
                    $punch = Breaktime::create([
                        'user_id' => auth()->user()->id,
                        'break_in' => date('H:i:s'),
                    ]);
                    return json_encode([
                        'status' => 1,
                    ]);   
                }
                return json_encode([
                    'status' => 0,
                ]);
            }else{
                $punch = Breaktime::create([
                    'user_id' => auth()->user()->id,
                    'break_in' => date('H:i:s'),
                ]);
                return json_encode([
                    'status' => 1,
                ]);
            }
        }else{

        }
    }


    function breakOut(){
        if(auth()->check()){
            $today = Carbon::today();
            $get_time = Breaktime::where('user_id', auth()->user()->id)->whereDate('created_at', $today)->orderBy('id','desc')->first();
            if(!empty($get_time)){
                if(empty($get_time->break_out)){
                    $get_time->update(['break_out' => date('H:i:s')]);
                    return json_encode([
                        'status' => 1,
                    ]);
                }else{
                    return json_encode([
                        'status' => 0,
                    ]);    
                }
            }else{
                return json_encode([
                    'status' => 0,
                ]);
            }
        }{

        }
    }

    function punchOut(){
        if(auth()->check()){
            $today = Carbon::today();
            $get_time = PunchTime::where('user_id', auth()->user()->id)->whereDate('created_at', $today)->orderBy('id','desc')->first();
            if(!empty($get_time)){
                if(empty($get_time->punch_out)){
                    $get_time->update(['punch_out' => date('H:i:s')]);
                    return json_encode([
                        'status' => 1,
                    ]);
                }else{
                    return json_encode([
                        'status' => 0,
                    ]);    
                }
            }else{
                return json_encode([
                    'status' => 0,
                ]);
            }
        }{

        }
    }

}
