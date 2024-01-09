<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['expected_time','user_id','project_id','name','description','status','qa_status','date'];

    static $pending = '0';
    static $complete = '1';
    static $in_processing = '2';
    static $on_hold = '3';
    static $for_review = '4';

    static $qa_pending = '0';
    static $qa_complete = '1';
    static $qa_reopened = '2';


    protected static function boot()
    {
        parent::boot();

        // Fetch events when the model is retrieved
        static::retrieved(function ($event) {
            $user = User::find($event->user_id);
            $event->employee_name = (isset($user->first_name) ? $user->first_name : '') . ' ' . (isset($user->last_name) ? $user->last_name : '');
            $event->is_manager = ManagerMap::where('project_id',$event->project_id)->where('type',ManagerMap::$manager)->where('user_id',auth()->user()->id)->count();
        });
    }
}
