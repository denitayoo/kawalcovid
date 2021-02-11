<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class FrontendController extends Controller
{
    public function index()
{
    $provinsi = DB::table('provinsis') ->select('provinsis.kode_provinsi','provinsis.nama_provinsi',
        DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
        DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
        DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
        ->join('kotas','provinsis.id','=','kotas.id_provinsi')
        ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
        ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
        ->join('rws','kelurahans.id','=','rws.id_kelurahan')
        ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
        ->groupBy('provinsis.id')
        ->get();
           return view('frontend.index',compact('provinsi'));
}
public function Indonesia()
{
              $positif = DB::table('jumlahkasuses')
              ->sum("jumlahkasuses.jumlah_positif");

              $sembuh = DB::table('jumlahkasuses')
              ->sum("jumlahkasuses.jumlah_sembuh");

              $meninggal = DB::table('jumlahkasuses')
              ->sum("jumlahkasuses.jumlah_meninggal");
              return view('frontend.index',compact('pos,sem,men'));  

}
}
