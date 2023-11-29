<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['gender','designation','state','probation_end_date','salary','date_of_join','date_of_birth','city','address','user_id'];


    protected static function boot()
    {
        parent::boot();

        // Fetch events when the model is retrieved
        static::retrieved(function ($event) {
            $user = User::find($event->user_id);
            $event->first_name = isset($user->first_name) ? $user->first_name :'';
            $event->last_name = isset($user->last_name) ? $user->last_name :'';
            $event->email = isset($user->email) ? $user->email :'';
            $event->mobile = isset($user->mobile) ? $user->mobile :'';
            $event->designation = config('constant.designation.'.$event->designation);
            $event->date_of_birth = date('d M,Y',strtotime($event->date_of_birth));
        });
    }

    public function user()
    {
        // Assuming the foreign key is 'user_id'
        return $this->belongsTo(User::class, 'user_id');
    }


}
