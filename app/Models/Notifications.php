<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'notifications';
    protected $fillable = [
        'id_user', 'date', 'status'
    ];

    protected $primaryKey = '_id';
    public function users_name() {
        return $this->belongsTo('App\Models\User', 'id_user', '_id');
      }
}