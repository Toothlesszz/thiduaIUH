<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'certification';
    protected $fillable = [
        'name_styli', 'image', 'code_user', 'date', 'id_regis',
    ];

    protected $primaryKey = '_id';
    // protected $table = 'certification';
}
