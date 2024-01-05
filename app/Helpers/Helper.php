<?php 

namespace App\Helpers;

use App\Models\Breaktime;
use App\Models\ManagerMap;
use App\Models\PunchTime;
use App\Models\Task;
use App\Models\TaskTime;
use Carbon\Carbon;

class Helper
{
    public static function myCustomMethod()
    {
        return 'Hello, this is a custom helper method!';
    }

    public static function getForReviewTaskCount(){
        $manager_project_ids = ManagerMap::where('user_id',auth()->user()->id)->pluck('project_id')->toArray();

        $task_count = Task::whereIn('project_id',$manager_project_ids)->where('status',Task::$for_review)->count();

        return $task_count;
    }


    public static function getEmployeeWH($user_id , $date){
        $get_time = PunchTime::where('user_id', $user_id)->whereDate('created_at', $date)->first();
        $get_break_time = Breaktime::where('user_id', $user_id)->whereDate('created_at', $date)->orderby('id','desc')->first();
        $startTime = Carbon::parse($get_time->punch_in);
        if(!empty($get_time->punch_out)){
            $endTime = Carbon::parse($get_time->punch_out);
            $punch_out_is = '1';
        }else{
            $endTime = Carbon::now();
        }
        $timeDifferenceInSeconds = $endTime->diffInSeconds($startTime);
        if(!empty($get_break_time)){
            $break_times = Breaktime::where('user_id', $user_id)->whereDate('created_at', $date)->orderby('id','asc')->get();
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
                    'message' => 'Timer Continue',
                    'break_time' => gmdate('H:i:s', $sum_of_break_second),
                ];
            }else{
                $return_data = [
                    'status' => 2,
                    'time' => $timeFormatted,
                    'second' => $timeDifferenceInSeconds - $sum_of_break_second,
                    'message' => 'On Break',
                    'break_time' => gmdate('H:i:s', $sum_of_break_second),
                ];
            }
        }else{
            $return_data = [
                'status' => 1,
                'time' => gmdate('H:i:s', $timeDifferenceInSeconds),
                'second' => $timeDifferenceInSeconds,
                'message' => 'Timer Continue',
                'break_time' => '0',
            ];
            
        }
        $punch_out_is = isset($punch_out_is) ? $punch_out_is :'';
        if($punch_out_is == 1){
            $return_data['status'] = 3;
            $return_data['message'] = 'Punch Out';
        }
        return $return_data;
    }



    public static function getTaskTime($task_id){
        $total_deff_seconds = 0;
        TaskTime::where('task_id',$task_id)->get()->map(function($task_time) use(&$total_deff_seconds){
            if(!empty($task_time->start_time)){
                $break_start = Carbon::parse($task_time->start_time);
            }else{
                $break_start = Carbon::now();
            }
            if(!empty($task_time->end_time)){
                $break_end = Carbon::parse($task_time->end_time);
            }else{
                $break_end = Carbon::now();
            }
            $timeBreakDifferenceInSeconds = $break_end->diffInSeconds($break_start);
            $total_deff_seconds += $timeBreakDifferenceInSeconds;
        });
        $timeFormatted = gmdate('H:i:s', $total_deff_seconds);
        return [$timeFormatted , $total_deff_seconds];
    }
}