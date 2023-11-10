<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Reregistration extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 're_registration';
    protected $fillable = [
        'id_user', 'date', 'id_competitionperiod'
    ];
    protected $primaryKey = '_id';
    public function users()
    {
      return $this->belongsTo('App\Models\User','id_user','_id');
    }
}
