<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Jenssegers\Mongodb\Eloquent\Model;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $connection = 'mongodb';
    protected $collection = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'gender', 'image', 'code', 'birthday', 'address', 'phone', 'email', 'course', 'type',
        'password', 'level', 'id_depart',
    ];

    // protected $primaryKey = 'id';
    // protected $table = 'users';

    public function department() {
      return $this->belongsTo('App\Models\Department', 'id_depart', '_id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
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
