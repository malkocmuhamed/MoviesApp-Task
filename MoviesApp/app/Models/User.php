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

    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static $rules = [
		'name' => [
			'required' => 'required'
		],
		'email' => [
			'required' => 'required', 
			'unique' => 'unique:users,email',
		],
		'password' => [
			'sometimes' => 'sometimes', 
			'confirmed' => 'confirmed',
		]
	];
	
    const ADMIN_ROLE = 1;
    const USER_ROLE = 2;

    public function isAdmin()
    {
        return $this->role === self::ADMIN_ROLE;
    }
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
