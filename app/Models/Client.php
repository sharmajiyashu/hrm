<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['gender','state','city','address','user_id','gst_number','company_name'];

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
        });
    }



}
