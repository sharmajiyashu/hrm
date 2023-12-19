<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PunchTime extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','punch_in','punch_out'];
}
