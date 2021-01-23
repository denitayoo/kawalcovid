<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kecamatan extends Model
{
    use HasFactory;

    protected $table='kecamatans';

    public function kota(){
        return $this->belongsTo('kota'::class);
    }
    public function kelurahan(){
        return $this->hasMany('kelurahan'::class);
    }
}
