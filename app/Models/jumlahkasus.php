<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jumlahkasus extends Model
{
    use HasFactory;

    protected $table='jumlahkasuses';

    public function rw(){
        return $this->belongsTo('rw'::class);
    }
}
