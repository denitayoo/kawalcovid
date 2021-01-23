<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kota extends Model
{
    use HasFactory;

    protected $table='kotas';

    public function provinsi(){
        return $this->belongsTo('provinsi'::class);
    }
    public function kecamatan(){
        return $this->hasMany('kecamatan'::class);
    }
}
