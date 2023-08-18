<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Years extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'years';
    protected $fillable = [
        'years',
    ];

    protected $primaryKey = '_id';
    // protected $table = 'years';

    public function stylized() {
      return $this->hasMany('App\Models\Stylized');
    }
}
