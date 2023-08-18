<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class CompetitionPeriod extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'competitionperiod';
    protected $fillable = [
        'id_styli', 'startday','endday','image', 'type', 'id_year', 'status'
    ];

    // protected $primaryKey = 'id';
    // protected $table = 'stylized';

    public function years() {
      return $this->belongsTo('App\Models\Years', 'id_year', '_id');
    }
    public function stylized() {
        return $this->belongsTo('App\Models\Stylized', 'id_styli', '_id');
      }

    public function compete() {
      return $this->hasMany('App\Models\Compete');
    }

    public function ceriterias() {
      return $this->hasMany('App\Models\Registration');
    }
    public function registration() {
      return $this->hasMany('App\Models\Ceriterias');
    }
}
