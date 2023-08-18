<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'registration';
    protected $fillable = [
        'id_user', 'date', 'id_competitionperiod', 'admin_status'
    ];

    protected $primaryKey = '_id';
    // protected $table = 'registration';

    public function criteria_detail() {
      return $this->belongsTo('App\Models\CeriteriasDetail', 'id_criteria_detail', '_id');
    }
    public function competitionperiod()
    {
      return $this->belongsTo('App\Models\CompetitionPeriod','id_competitionperiod','_id');
    }
    public function registration_detail() {
      return $this->hasMany('App\Models\RegistrationDetails');
    }
    public function users()
    {
      return $this->belongsTo('App\Models\User','id_user','_id');
    }
}
