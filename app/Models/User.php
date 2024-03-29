<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    static $admin = 1;
    
    public function isAdmin()
    {
        // Implement logic to check if the user is an admin
        return $this->role == '1'; // Adjust this based on your user role implementation
    }

    public function isEmployee()
    {
        // Implement logic to check if the user is an admin
        return $this->role == '0'; // Adjust this based on your user role implementation
    }

    public function employee()
    {
        // Assuming the foreign key is 'user_id' in the 'employees' table
        return $this->hasOne(Employee::class, 'user_id');
    }

    protected $fillable = [
        'first_name',
        'last_name',
        'mobile',
        'email',
        'password',
        'password_2',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
