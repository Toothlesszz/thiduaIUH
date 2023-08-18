<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;


class Compete extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'compete';
    protected $fillable = [
        'name', 'author', 'date', 'summary', 'content', 'active', 'id_styli',
    ];

    protected $primaryKey = '_id';
    // protected $table = 'compete';

    public function stylized() {
      return $this->belongsTo('App\Models\Stylized', 'id_styli', '_id');
    }
}
