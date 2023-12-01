<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name','start_date' ,'end_date','client','amount','description','category'];

    protected static function boot()
    {
        parent::boot();

        // Fetch events when the model is retrieved
        static::retrieved(function ($event) {
            
            $event->category = config('constant.project_category.'.$event->category);
            
        });
    }
    
}
