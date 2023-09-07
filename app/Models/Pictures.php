<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Pictures extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'picture_storage';
    protected $fillable = [
        'id_user', 'time', 'name'
    ];

    protected $primaryKey = '_id';
}
