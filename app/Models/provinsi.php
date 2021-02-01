<?php

namespace App\Models;
use App\Models\Kota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provinsi extends Model
{
   

    public function Kota () {
        return $this->hasMany('App\Models\Kota','id_provinsi');
    }
    use HasFactory;
}
