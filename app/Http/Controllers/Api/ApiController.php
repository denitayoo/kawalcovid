<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Jumlahkasus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public $data = [];
    public function global()
    {
        $response = Http::get('https://api.kawalcorona.com')->json();
        foreach ($response as $data => $val) {
        $raw = $val['attributes'];
        $res = [
            'Negara' => $raw['Country_Region'],
            'Positif' => $raw['Confirmed'],
            'Sembuh' => $raw['Recovered'],
            'Meninggal' => $raw['Deaths']
        ];
        array_push($this->data, $res);
    }
    $data = [
        'Succes' => true,
        'Data' => $this->data,
        'Message' => 'Berhasil'
    ];
    return response()->json($data,200);
    }
public function index()
{
    $data = DB::table('jumlahkasuses')
            ->select(DB::raw('provinsis.nama_provinsi as provinsi'),
                     DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
                     DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'),
                     DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'))
            ->join('rws', 'rws.id', '=', 'jumlahkasuses.id_rw')
            ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
            ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
            ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kota')
            ->join('provinsis', 'provinsis.id', '=', 'kotas.id_provinsi')  
            ->groupBy('provinsis.nama_provinsi')
        ->get();           
    $res = [
        'success'   => true,
        'data'      => $data,
        'message'   => 'Data kasus ditampilkan'
    ];
    return response()->json($res,200);
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
  
  
        public function provinsi(){
            $allday = DB::table('provinsis')
            ->select('provinsis.kode_provinsi','provinsis.nama_provinsi',
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

            $today = DB::table('provinsis')
            ->select('provinsis.kode_provinsi','provinsis.nama_provinsi',
            DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
            DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
            DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
            ->join('kotas','provinsis.id','=','kotas.id_provinsi')
            ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
            ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
            ->join('rws','kelurahans.id','=','rws.id_kelurahan')
            ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
            ->whereDate('jumlahkasuses.tanggal',Carbon::today())
            ->groupBy('provinsis.id')
            ->get();
    
            $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
            $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
            $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
        // dd($provinsi);
        return response([
            'Success' => true,
            'Data' => [
                        'Hari Ini' => $today,
            'Data' => [
                        'Provinsi' => $allday,
            'Total' =>[
                        'Jumlah Positif' => $positif,
                        'Jumlah Sembuh' => $sembuh,
                        'Jumlah Meninggal' => $meninggal,
                    ],
                    'Message' => ' Berhasil!',
                ],
            ],
        ]);

    }
   

    public function provinsis($id){

        $provinsi = DB::table('provinsis') ->select('provinsis.kode_provinsi','provinsis.nama_provinsi',
        DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
        DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
        DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
        ->join('kotas','provinsis.id','=','kotas.id_provinsi')
        ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
        ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
        ->join('rws','kelurahans.id','=','rws.id_kelurahan')
        ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
        ->where('provinsis.id',$id)
        ->groupBy('provinsis.id')
        ->first();
            $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
            $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
            $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
        // dd($provinsi);
        return response([
            'Success' => true,
            'Data' => $provinsi,
            'Total' =>[
                        'Jumlah Positif' => $positif,
                        'Jumlah Sembuh' => $sembuh,
                        'Jumlah Meninggal' => $meninggal,
                    ],
                    'message' => ' Berhasil!',

        ]);
    }

    public function kota(){
        $allday = DB::table('kotas')
        ->select('kotas.kode_kota','kotas.nama_kota',
        DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
        DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
        DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
        ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
        ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
        ->join('rws','kelurahans.id','=','rws.id_kelurahan')
        ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
        ->groupBy('kotas.id')
        ->get();
        
        $today = DB::table('kotas')
        ->select('kotas.kode_kota','kotas.nama_kota',
        DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
        DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
        DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
        ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
        ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
        ->join('rws','kelurahans.id','=','rws.id_kelurahan')
        ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
        ->whereDate('jumlahkasuses.tanggal',Carbon::today())
        ->groupBy('kotas.id')
        ->get();
    
        $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
        $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
        $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
    // dd($provinsi);
    return response([
        'Success' => true,
        'Data' => [
                    'Hari Ini' => $today,
        'Data' => [
                    'Kota' => $allday,
        'Total' =>[
                    'Jumlah Positif' => $positif,
                    'Jumlah Sembuh' => $sembuh,
                    'Jumlah Meninggal' => $meninggal,
                ],
                'Message' => ' Berhasil!',
            ],
        ],
    ]);

}

    public function kotas($id){
        $kota = DB::table('kotas')
        ->select('kotas.kode_kota','kotas.nama_kota',
        DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
        DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
        DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
        ->join('kecamatans','kotas.id','=','kecamatans.id_kota')
        ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
        ->join('rws','kelurahans.id','=','rws.id_kelurahan')
        ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
        ->where('kotas.id',$id)
        ->groupBy('kotas.id')
        ->first();
            $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
            $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
            $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
        // dd($provinsi);
        return response([
            'Success' => true,
            'Data' => $kota,
            'Total' =>[
                        'Jumlah Positif' => $positif,
                        'Jumlah Sembuh' => $sembuh,
                        'Jumlah Meninggal' => $meninggal,
                    ],
                    'message' => ' Berhasil!',
        ]);

    }
public function kecamatan(){
    $allday = DB::table('kecamatans')
    ->select('kecamatans.nama_kecamatan',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
    ->join('rws','kelurahans.id','=','rws.id_kelurahan')
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->groupBy('kecamatans.id')
    ->get();

    $today = DB::table('kecamatans')
    ->select('kecamatans.nama_kecamatan',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
    ->join('rws','kelurahans.id','=','rws.id_kelurahan')
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->whereDate('jumlahkasuses.tanggal',Carbon::today())
    ->groupBy('kecamatans.id')
    ->get();

        $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
        $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
        $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
    // dd($provinsi);
    return response([
        'Success' => true,
        'Data' => [
                    'Hari Ini' => $today,
        'Data' => [
                    'Kecamatan' => $allday,            
        'Total' =>[
                    'Jumlah Positif' => $positif,
                    'Jumlah Sembuh' => $sembuh,
                    'Jumlah Meninggal' => $meninggal,
                ],
                'message' => ' Berhasil!',
            ],
        ],
    ]);

}
public function kecamatans($id){
    $kecamatan = DB::table('kecamatans')
    ->select('kecamatans.nama_kecamatan',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('kelurahans','kecamatans.id','=','kelurahans.id_kecamatan')
    ->join('rws','kelurahans.id','=','rws.id_kelurahan')
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->where('kecamatans.id',$id)
    ->groupBy('kecamatans.id','tanggal')
    ->first();
        $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
        $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
        $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
    // dd($provinsi);
    return response([
        'success' => true,
        'data' => $kecamatan,
        'Total' =>[
                    'Jumlah Positif' => $positif,
                    'Jumlah Sembuh' => $sembuh,
                    'Jumlah Meninggal' => $meninggal,
                ],
                'message' => ' Berhasil!',
    ]);

}
public function kelurahan(){
    $allday = DB::table('kelurahans')
    ->select('kelurahans.nama_kelurahan',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('rws','kelurahans.id','=','rws.id_kelurahan')
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->groupBy('kelurahans.id')
    ->get();

    $today = DB::table('kelurahans')
    ->select('kelurahans.nama_kelurahan',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('rws','kelurahans.id','=','rws.id_kelurahan')
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->whereDate('jumlahkasuses.tanggal',Carbon::today())
    ->groupBy('kelurahans.id')
    ->get();

        $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
        $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
        $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
    // dd($provinsi);
    return response([
        'Success' => true,
        'Data' => [
                    'Hari Ini' => $today,
        'Data' => [
                    'Kelurahan' => $allday,      
        'Total' =>[
                    'Jumlah Positif' => $positif,
                    'Jumlah Sembuh' => $sembuh,
                    'Jumlah Meninggal' => $meninggal,
                ],
                'message' => ' Berhasil!',
            ],
        ],
    ]);

}
public function kelurahans($id){
    $kelurahan = DB::table('kelurahans')
    ->select('kelurahans.nama_kelurahan',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('rws','kelurahans.id','=','rws.id_kelurahan')
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->where('kelurahans.id',$id)
    ->groupBy('kelurahans.id','tanggal')
    ->first();
        $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
        $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
        $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
    // dd($provinsi);
    return response([
        'Success' => true,
        'Data'  => $kelurahan,
        'Total' =>[
                    'Jumlah Positif' => $positif,
                    'Jumlah Sembuh' => $sembuh,
                    'Jumlah Meninggal' => $meninggal,
                ],
                'message' => ' Berhasil!',
    ]);

}
public function rw(){
    $allday = DB::table('rws')
    ->select('rws.nama_rw',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->groupBy('rws.id','tanggal')
    ->get();

    $today = DB::table('rws')
    ->select('rws.nama_rw',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->whereDate('jumlahkasuses.tanggal',Carbon::today())
    ->groupBy('rws.id','tanggal')
    ->get();

        $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
        $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
        $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
    // dd($provinsi);
    return response([
        'Success' => true,
        'Data' => [
                    'Hari Ini' => $today,
        'Data' => [
                    'Rw' => $allday,
        'Total' =>[
                    'Jumlah Positif' => $positif,
                    'Jumlah Sembuh' => $sembuh,
                    'Jumlah Meninggal' => $meninggal,
                ],
                'Message' => ' Berhasil!',
            ],
        ],
    ]);

}
public function rws($id){
    $rw = DB::table('rws')
    ->select('rws.nama_rw',
    DB::raw('SUM(jumlahkasuses.jumlah_positif) as positif'),
    DB::raw('SUM(jumlahkasuses.jumlah_sembuh) as sembuh'),
    DB::raw('SUM(jumlahkasuses.jumlah_meninggal) as meninggal'))
    ->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')
    ->where('rws.id',$id)
    ->groupBy('rws.id','tanggal')
    ->first();
        $positif = DB::table('rws')->select('jumlahkasuses.jumlah_positif')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_positif');
        $sembuh = DB::table('rws')->select('jumlahkasuses.jumlah_sembuh')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_sembuh');
        $meninggal = DB::table('rws')->select('jumlahkasuses.jumlah_meninggal')->join('jumlahkasuses','rws.id','=','jumlahkasuses.id_rw')->sum('jumlahkasuses.jumlah_meninggal');
    // dd($provinsi);
    return response([
        'Success' => true,
        'Data' => $rw,
        'Total' =>[
                    'Jumlah Positif' => $positif,
                    'Jumlah Sembuh' => $sembuh,
                    'Jumlah Meninggal' => $meninggal,
                ],
                'Message' => ' Berhasil!',
    ]);

}

    public function positif(){
        $jumlah_positif = DB::table('jumlahkasuses')->select('jumlahkasuses.jumlah_positif')->sum('jumlahkasuses.jumlah_positif');
        return response([
            'success' => true,
            'data' => [
                'name' => 'Total Positif',
                'value' => $jumlah_positif,
            ],
                    'message' => ' Berhasil!',

        ]);
    }
    public function sembuh(){
        $jumlah_sembuh = DB::table('jumlahkasuses')->select('jumlahkasuses.jumlah_sembuh')->sum('jumlahkasuses.jumlah_sembuh');
        return response([
            'success' => true,
            'data' => [
                        'name' => 'Total Sembuh',
                        'value' => $jumlah_sembuh,
            ],
                    'message' => ' Berhasil!',

        ]);
    }
    public function meninggal(){
        $jumlah_meninggal = DB::table('jumlahkasuses')->select('jumlahkasuses.jumlah_meninggal')->sum('jumlahkasuses.jumlah_meninggal');
        return response([
            'success' => true,
            'data' => [
                        'name' => 'Total Meninggal',
                        'value' => $jumlah_meninggal,
            ],
                    'message' => ' Berhasil!',

        ]);
    }
    }

