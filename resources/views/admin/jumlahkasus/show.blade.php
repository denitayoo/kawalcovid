@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><br>
                Show
                </div>
                <div class="card-body">
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label>Provinsi</label>
                            <input type="text" value="{{$jumlahkasus->rw->kelurahan->kecamatan->kota->provinsi->nama_provinsi}}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Total Reaktif</label>
                            <input type="text" value="{{$jumlahkasus->reaktif}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label>Kota </label>
                            <input type="text" value="{{$jumlahkasus->rw->kelurahan->kecamatan->kota->nama_kota}}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Total Positif</label>
                            <input type="text" value="{{$jumlahkasus->jumlah_positif}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label>Kecamatan</label>
                            <input type="text"  value="{{$jumlahkasus->rw->kelurahan->kecamatan->nama_kecamatan}}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Total Sembuh</label>
                            <input type="text"  value="{{$jumlahkasus->jumlah_sembuh}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label>Kelurahan / Desa</label>
                            <input type="text"  value="{{$jumlahkasus->rw->kelurahan->nama_kelurahan}}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Total Meninggal</label>
                            <input type="text"  value="{{$jumlahkasus->jumlah_meninggal}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-md-6">
                            <label>Rw</label>
                            <input type="text"  value="{{$jumlahkasus->rw->nama_rw}}" class="form-control" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Tanggal</label>
                            <input type="text"  value="{{$jumlahkasus->tanggal}}" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection