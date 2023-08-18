<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use MongoDB\Driver\Manager;

class Stylized extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'stylized';
    protected $fillable = [
        'name', 'image', 'type', 'id_year', 'number', 'status',  'file'
    ];

    // protected $primaryKey = '_id';
    // protected $table = 'stylized';

    public function years() {
      return $this->belongsTo('App\Models\Years', 'id_year', '_id');
    }

    public function compete() {
      return $this->hasMany('App\Models\Compete');
    }

    public function ceriterias() {
      return $this->hasMany('App\Models\Ceriterias');
    }
    public function competitionperiod() {
      return $this->belongsto('App\Models\CompetitionPeriod');
    }
}
