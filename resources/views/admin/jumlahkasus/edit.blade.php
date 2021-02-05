@extends('layouts.master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Data kasus
                </div>
                <div class="card-body">
                    <form action="{{route('jumlahkasus.update',$jumlahkasus->id)}}" method="post">
                        @csrf @method('put')
                        <div class="row">
                            <div class="col">
                                @livewire('dropdowns',['selectedRw'=>$jumlahkasus->id_rw,'selectedKelurahan'=>$jumlahkasus->rw->id_kelurahan,
                                            'selectedKecamatan'=>$jumlahkasus->rw->kelurahan->id_kecamatan,
                                            'selectedKota'=>$jumlahkasus->rw->kelurahan->kecamatan->id_kota,
                                            'selectedProvinsi'=>$jumlahkasus->rw->kelurahan->kecamatan->kota->id_provinsi])
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Reaktif</label>
                                    <input type="text" name="reaktif" class="form-control" value="{{$jumlahkasus->reaktif}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">positif</label>
                                    <input type="text" name="jumlah_positif" class="form-control" value="{{$jumlahkasus->jumlah_positif}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">sembuh</label>
                                    <input type="text" name="jumlah_sembuh" class="form-control" value="{{$jumlahkasus->jumlah_sembuh}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">meninggal</label>
                                    <input type="text" name="jumlah_meninggal" class="form-control" value="{{$jumlahkasus->jumlah_meninggal}}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" value="{{$jumlahkasus->tanggal}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

