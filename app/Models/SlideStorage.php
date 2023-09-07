<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class SlideStorage extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';
    protected $collection = 'slide_storage';
    protected $fillable = [
        'id_user', 'time', 'images'
    ];

    protected $primaryKey = '_id';
    public function pictures() {
        return $this->belongsTo('App\Models\Pictures', 'images', '_id');
      }
}
