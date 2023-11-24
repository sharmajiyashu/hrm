<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emi extends Model
{
    use HasFactory;

    protected $fillable = ['loan_id','user_id','emi_number','emi','due_amount','interest','principal','status','partial_date','emi_date'];
}
