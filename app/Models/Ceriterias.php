<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Ceriterias extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'criterias';
    protected $fillable = [
        'name_criter', 'number', 'id_styli','intruction'
    ];

    protected $primaryKey = '_id';
    // protected $table = 'criterias';

    public function stylizedCeriter() {
      return $this->belongsTo('App\Models\Stylized', 'id_styli', '_id');
    }

    public function criteria_detail() {
      return $this->hasMany('App\Models\CeriteriasDetail');
    }
}