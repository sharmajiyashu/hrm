<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\PunchTime;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function dashboard(){
        return view('admin.dashboard');
    }


    function timeSheet(){
        $startDate = Carbon::now()->startOfWeek(); // Start of the week
        $endDate = Carbon::now()->endOfWeek();     // End of the week

        // Get an array of days in the current week
        $current_week_days = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $current_week_days[] = $currentDate->format('Y-m-d'); // 'l' format returns the full day name (e.g., Monday)
            $currentDate->addDay(); // Move to the next day
        }

        // $current_week_days now contains an array of day names for the current week
        // echo "<pre>";
        // print_r($current_week_days);


        $employees = Employee::get()->map(function($employee) use($current_week_days){
            $time_sheet = [] ;
            foreach($current_week_days as $date){
                $punch_time = PunchTime::where('user_id',$employee->user_id)->whereDate('created_at',$date)->first();
                if(!empty($punch_time)){
                    $time = Helper::getEmployeeWH($employee->user_id,$date);
                    // print_r($time);die;
                    $punch_time['working_hour'] = $time['time'];
                    $punch_time['break_hour'] = $time['break_time'];
                }else{
                    $punch_time['working_hour'] = '-';
                    $punch_time['break_hour'] = '-';
                }
                
                $punch_time['date'] = $date;
                $time_sheet[] = $punch_time;
            }
            $employee->time_sheet = $time_sheet;
            return $employee;
        });

        return view('admin.time_sheet',compact('current_week_days','employees'));
    }

}
