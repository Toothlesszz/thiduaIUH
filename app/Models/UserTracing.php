<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class UserTracing extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'user_tracing';
    protected $fillable = [
        'user_id', 'time', 'content'
    ];

    protected $primaryKey = '_id';
    public function users() {
        return $this->belongsTo('App\Models\User', 'id_user', '_id');
      }
}
