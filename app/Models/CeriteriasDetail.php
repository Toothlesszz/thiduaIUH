<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class CeriteriasDetail extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'criteria_detail';
    protected $fillable = [
        'name', 'request', 'id_criter',
    ];

    protected $primaryKey = '_id';
    // protected $table = 'criteria_detail';

    public function registration() {
      return $this->hasMany('App\Models\Registration');
    }

    public function ceriterias() {
      return $this->belongsTo('App\Models\Ceriterias', 'id_criter', '_id');
    }
}

