<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class RegistrationDetails extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'registration_detail';
    protected $fillable = [
        'proof_file', 'id_criteria_detail', 'id_regis', 'revelation', 'reason'
    ];

    protected $primaryKey = '_id';
    // protected $table = 'registration_detail';

    public function registration() {
      return $this->belongsTo('App\Models\Registration', 'id_regis', '_id');
    }
}
