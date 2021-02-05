<?php

namespace App\Http\Controllers;

use App\Models\Jumlahkasus;
use App\Models\Rw;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;


use Illuminate\Http\Request;

class JumlahkasusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
        $jumlahkasus = Jumlahkasus::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
        return view('admin.jumlahkasus.index',compact('jumlahkasus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rw = Rw::all();
        return view('admin.jumlahkasus.create',compact('rw'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jumlahkasus = new Jumlahkasus();
        $jumlahkasus->reaktif   =$request->reaktif;
        $jumlahkasus->jumlah_positif   =$request->jumlah_positif;
        $jumlahkasus->jumlah_sembuh    =$request->jumlah_sembuh;
        $jumlahkasus->jumlah_meninggal =$request->jumlah_meninggal;
        $jumlahkasus->tanggal          =$request->tanggal;
        $jumlahkasus->id_rw            =$request->id_rw;
        $jumlahkasus->save();
        return redirect()->route('jumlahkasus.index')->with(['succes'=>'Data Berhasil diinput']);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\jumlahkasus  $jumlahkasus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $title = 'Detail kasus';
        $jumlahkasus = Jumlahkasus::findOrFail($id);
        $rw = Rw::all();
        $kelurahan = Kelurahan::all();
        $kecamatan = Kecamatan::all();
        $kota      = Kota::all();
        $provinsi  = Provinsi::all();
        return view('admin.jumlahkasus.show',compact('rw','kelurahan','kecamatan','kota','provinsi','jumlahkasus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\jumlahkasus  $jumlahkasus
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rw = Rw::all();
        $jumlahkasus = Jumlahkasus::findOrFail($id);
        return view('admin.jumlahkasus.edit',compact('jumlahkasus','rw'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\jumlahkasus  $jumlahkasus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jumlahkasus = Jumlahkasus::findOrFail($id);
        $jumlahkasus->reaktif   =$request->reaktif;
        $jumlahkasus->jumlah_positif   =$request->jumlah_positif;
        $jumlahkasus->jumlah_sembuh    =$request->jumlah_sembuh;
        $jumlahkasus->jumlah_meninggal =$request->jumlah_meninggal;
        $jumlahkasus->tanggal          =$request->tanggal;
        $jumlahkasus->id_rw            =$request->id_rw;
        $jumlahkasus->save();
        return redirect()->route('jumlahkasus.index')->with(['succes'=>'Data <b>',$jumlahkasus->jumlah_positif,'</b>Data Berhasil diubah']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\jumlahkasus  $jumlahkasus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jumlahkasus = Jumlahkasus::findOrFail($id); 
        $jumlahkasus->delete();
        return redirect()->route('jumlahkasus.index')->with(['success'=>'Data <b>',$jumlahkasus->jumlah_positif,'</b> Berhasil dihapus']);
    }
}



