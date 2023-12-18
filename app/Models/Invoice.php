<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['due_date','due_amount','paid_amount','total','gst','tax_rate','tax','sub_total','user_id','project_id','created_at'];
}
