<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'department';
    protected $fillable = [
        'code_depart', 'name_depart',
    ];

    protected $primaryKey = '_id';
    // protected $table = 'department';

    public function user() {
      return $this->hasMany('App\Models\User');
    }
}
