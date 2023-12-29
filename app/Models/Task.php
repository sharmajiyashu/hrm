<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['expected_time','user_id','project_id','name','description','status','qa_status','date'];

    static $pending = '0';
}
