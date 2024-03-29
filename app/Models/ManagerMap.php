<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerMap extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','project_id','type'];
    
    static $manager = "1";
    static $team = "0";
}
