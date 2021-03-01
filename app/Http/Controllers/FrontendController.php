<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        $positif = DB::table('rws')
        ->select('jumlahkasuses.jumlah_positif',
        'jumlahkasuses.jumlah_sembuh', 'jumlahkasuses.jumlah_meninggal')
        ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
        ->sum('jumlahkasuses.jumlah_positif'); 
    $sembuh = DB::table('rws')
        ->select('jumlahkasuses.jumlah_positif',
        'jumlahkasuses.jumlah_sembuh','jumlahkasuses.jumlah_meninggal')
        ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
        ->sum('jumlahkasuses.jumlah_sembuh');
    $meninggal = DB::table('rws')
        ->select('jumlahkasuses.jumlah_positif',
        'jumlahkasuses.jumlah_sembuh','jumlahkasuses.jumlah_meninggal')
        ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
        ->sum('jumlahkasuses.jumlah_meninggal');
    // $globalpositif = file_get_contents('https://api.kawalcorona.com/positif');
    // $posglobal = json_decode($globalpositif, TRUE);
    // $globalsembuh= file_get_contents('https://api.kawalcorona.com/sembuh');
    // $semglobal = json_decode($globalsembuh, TRUE);
    // $globalmeninggal = file_get_contents('https://api.kawalcorona.com/meninggal');
    // $menglobal = json_decode($globalmeninggal, TRUE);
    // Date
    $tanggal = Carbon::now()->format('D d-M-Y h:i:s');

    // Table Provinsi
    $tampil = DB::table('provinsis')
              ->join('kotas','kotas.id_provinsi','=','provinsis.id')
              ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
              ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
              ->join('rws','rws.id_kelurahan','=','kelurahans.id')
              ->join('jumlahkasuses','jumlahkasuses.id_rw','=','rws.id')
              ->select('nama_provinsi',
                      DB::raw('SUM(jumlahkasuses.jumlah_positif) as Positif'),
                      DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as Sembuh'),
                      DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as Meninggal'))
              ->groupBy('nama_provinsi')->orderBy('nama_provinsi','ASC')
              ->get();

    // Table Global
    // $datadunia= file_get_contents("https://api.kawalcorona.com/");
    // $dunia = json_decode($datadunia, TRUE);
    // ,'posglobal','semglobal','menglobal','dunia'
        
    return view('frontend.index',compact('positif','sembuh','meninggal', 'tanggal','tampil'));
    }
        
}