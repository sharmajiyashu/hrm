<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['user_id','loan_id','type','loan_amount','tenure','emi','interest_amount','total_amount_paid','rate_of_interest','start_emi'];

    protected static function boot()
    {
        parent::boot();
        static::creating (function ($model) {
            $model->loan_id = 'LA'.mt_rand(1000000, 9999999);
        });

        static::retrieved(function ($event) {
            $user = User::find($event->user_id);
            $event->first_name = isset($user->first_name) ? $user->first_name :'';
            $event->last_name = isset($user->last_name) ? $user->last_name :'';
            $event->email = isset($user->email) ? $user->email :'';
            $event->mobile = isset($user->mobile) ? $user->mobile :'';
            $event->start_month = date('M-y',strtotime($event->start_emi));
        });




    }
}
