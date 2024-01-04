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
}
