<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rw extends Model
{
    use HasFactory;

    public function kelurahan(){
        return $this->belongsTo('kelurahan'::class);
    }
    public function jumlahkasus(){
        return $this->hasMany('jumlahkasus'::class);
    }
}
