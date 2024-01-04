<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskTime extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['end_time','start_time','task_id'];

    

}
