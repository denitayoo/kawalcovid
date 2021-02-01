<?php

namespace App\Models;
use App\Models\Kelurahan;
use App\Models\Jumlahkasus;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rw extends Model
{
    public function Kelurahan () {
        return $this->belongsTo('App\Models\Kelurahan','id_kelurahan');
    }
    public function Jumlahkasus () {
        return $this->hasMany('App\Models\Jumlahkasus','id_rw');
    }
    use HasFactory;
}
