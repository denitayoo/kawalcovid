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

public function Indonesia(){
    $jumlah_positif = DB::table('jumlahkasuses')
                    ->select('jumlahkasuses.jumlah_positif')
                    ->sum('jumlahkasuses.jumlah_positif');

    $jumlah_sembuh = DB::table('jumlahkasuses')
                    ->select('jumlahkasuses.jumlah_sembuh')
                    ->sum('jumlahkasuses.jumlah_sembuh');

    $jumlah_meninggal = DB::table('jumlahkasuses')
                    ->select('jumlahkasuses.jumlah_meninggal')
                    ->sum('jumlahkasuses.jumlah_meninggal');

    return response([
                'success' => true,
                'data' => [
                'name' => 'Indonesia',
                'jumlah_positif'=> $jumlah_positif,
                'jumlah_sembuh'=> $jumlah_sembuh,
                'jumlah_meninggal'=> $jumlah_meninggal,
                        ],
                                'message' => ' Berhasil!',

                    ]);

}
}
